<?php
namespace App\Http\Controllers;
use App;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Business;
use App\Characteristic;
use App\Differential;
use App\Traits\UploadTrait;
use App\Traits\SlugTrait;
use App\Traits\NotificationTrait;
class BusinessesController extends Controller
{
    use UploadTrait, SlugTrait, NotificationTrait;
    /**
     * Addresses
     *
     * Lista endereços dos empreendimentos
     */
    public function addresses()
    {
        $businesses = Business::select('latitude', 'longitude', 'title', 'name')
            ->join('business_business_category', 'businesses.id', '=', 'business_business_category.business_id')
            ->join(
                'business_categories',
                'business_categories.id',
                '=',
                'business_business_category.business_category_id'
            )
            ->groupBy('businesses.id')
            ->get();
        return response()->json($businesses);
    }
    /**
     * Featured
     *
     * Lista todos os empreendimentos destaque
     */
    public function featured()
    {
        $businesses = Business::select('id', 'slug', 'title', 'image', 'neighborhood', 'business_filter_id')
            ->where('featured', 1)->orderBy('businesses.id', 'desc')->limit(3)->get();
        foreach ($businesses as $business) {
            $business->category;
            $business->filter;
            $business->tags;
            $business->mainCharacteristics;
            if ($business->image) {
                $business->image = asset($business->image);
            }
            foreach ($business->mainCharacteristics as $characteristic) {
                $characteristic->image = asset($characteristic->image);
            }
        }
        return $businesses;
    }
    public function all(Request $request)
    {
        $filters = $request->all();
        if (!empty($filters['notPaginate']) && ($filters['notPaginate'] == true || $filters['notPaginate'] == 1)) {
            $businesses = $this->listNotPaginated($filters);
        }
        if (empty($filters['notPaginate']) || $filters['notPaginate'] == false || $filters['notPaginate'] == 0) {
            $businesses = $this->listPaginated($filters);
        }
        foreach ($businesses as $business) {
            $business->category;
            $business->filter;
            $business->tags;
            $business->mainCharacteristics;
            if ($business->image) {
                $business->image = asset($business->image);
            }
            if ($business->background_image) {
                $business->background_image = asset($business->background_image);
            }
            foreach ($business->mainCharacteristics as $characteristic) {
            	if (!empty($characteristic->image)) {
                	$characteristic->image = asset($characteristic->image);
            	}
            }
        }
        return response()->json($businesses);
    }
    public function businessesFilter(Request $request)
    {
        $filters = $request->all();
        $businesses = Business::where('business_filter_id', $filters['filter'])->get();
        foreach ($businesses as $business) {
            $business->category;
            $business->filter;
            $business->tags;
            $business->mainCharacteristics;
            if ($business->image) {
                $business->image = asset($business->image);
            }
            if ($business->background_image) {
                $business->background_image = asset($business->background_image);
            }
            foreach ($business->mainCharacteristics as $characteristic) {
            	if (!empty($characteristic->image)) {
                	$characteristic->image = asset($characteristic->image);
            	}
            }
        }
        return response()->json($businesses);
    }
    /**
     * Details
     *
     * Exibe detalhes de um empreendimento
     */
    public function details($business)
    {
        $business = Business::where('slug', $business)->first();
        $business->mainCharacteristics;
        $business->differentials;
        $business->tags;
        $business->suroundings;
        $business->menus;
        if ($business->image) {
            $business->image = asset($business->image);
        }
        if ($business->folder_image) {
            $business->folder_image = asset($business->folder_image);
        }
        if ($business->title_image) {
            $business->title_image = asset($business->title_image);
        }
        if ($business->background_image) {
            $business->background_image = asset($business->background_image);
        }
        if ($business->internal_image) {
            $business->internal_image = asset($business->internal_image);
        }
        foreach ($business->differentials as $differential) {
            if (!empty($differential->image)) {
                $differential->image = asset($differential->image);
            }
        }
        foreach ($business->mainCharacteristics as $characteristic) {
            if (!empty($characteristic->image)) {
                $characteristic->image = asset($characteristic->image);
            }
        }
        foreach ($business->characteristics as $characteristic) {
            if (!empty($characteristic->image)) {
                $characteristic->image = asset($characteristic->image);
            }
        }
        $business->start_date = strftime('%b/%Y', strtotime($business->start_date));
        $business->end_date = strftime('%b/%Y', strtotime($business->end_date));
        return $business;
    }
    /**
     * List
     *
     * Lista todos os empreendimentos
     */
    public function index(Request $request)
    {
        $request = $request->all();
        $businesses = Business::select('id', 'title', 'for_sale', 'background_image', 'image')
            ->orderBy('businesses.id', 'desc')
            ->where(function($query) use ($request){
                if (!empty($request['search'])) {
                    $query->where('title', 'like', '%'.$request['search'].'%');
                }
                if (!empty($filters['for_sale']) && $filters['for_sale'] != 'undefined') {
                    $query->where('for_sale', $filters['for_sale']);
                }
            })
            ->paginate();
        foreach ($businesses as $business) {
            if ($business->image) {
                $business->image = asset($business->image);
            }
            if ($business->background_image) {
                $business->background_image = asset($business->background_image);
            }
        }
        return $businesses;
    }
    /**
     * Store
     *
     * Cadastra um novo empreendimento.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $validation = $this->validation($data, 'store');
        if ($validation->fails()) {
            return response()->json(['errors' => $validation->errors()], 406);
        }
        if (!$image = $this->uploadValidFile('business', $data['image'])) {
            return response()->json(['errors' => 'image cannot be uploaded'], 500);
        }
        $folderImage = null;
        if (!empty($data['folder_image']) && $data['folder_image'] != 'undefined') {
            if (!$folderImage = $this->uploadValidFile('business', $data['folder_image'])) {
                return response()->json(['errors' => 'folder_image cannot be uploaded'], 500);
            }
        }
        $titleImage = null;
        if (!empty($data['title_image'])) {
            if (!$titleImage = $this->uploadValidFile('business', $data['title_image'])) {
                return response()->json(['errors' => 'title_image cannot be uploaded'], 500);
            }
        }
        $backgroundImage = null;
        if (!empty($data['background_image'])) {
            if (!$backgroundImage = $this->uploadValidFile('business', $data['background_image'])) {
                return response()->json(['errors' => 'background_image cannot be uploaded'], 500);
            }
        }
        // $internalImage = null;
        // if (!empty($data['internal_image'])) {
        //     if (!$internalImage = $this->uploadValidFile('business', $data['internal_image'])) {
        //         return response()->json(['errors' => 'internal_image cannot be uploaded'], 500);
        //     }
        // }
        $data['image'] = $image;
        $data['folder_image'] = $folderImage;
        $data['title_image'] = $titleImage;
        $data['background_image'] = $backgroundImage;
        // $data['internal_image'] = $internalImage;
        $data['slug'] = $this->getSlug($data['title'], 'businesses');
        $newBusiness = Business::create($data);
        if (isset($data['business_categories'])) {
            $newBusiness->category()->sync($data['business_categories']);
        }
        if (isset($data['business_tags'])) {
            $newBusiness->tags()->sync($data['business_tags']);
        }
        if (isset($data['business_menus'])) {
            $newBusiness->menus()->sync($data['business_menus']);
        }
        
        $newBusiness->image = asset($newBusiness->image);
        if ($newBusiness->folder_image) {
            $newBusiness->folder_image = asset($newBusiness->folder_image);
        }
        if ($newBusiness->title_image) {
            $newBusiness->title_image = asset($newBusiness->title_image);
        }
        if ($newBusiness->background_image) {
            $newBusiness->background_image = asset($newBusiness->background_image);
        }
        // if ($newBusiness->internal_image) {
        //     $newBusiness->internal_image = asset($newBusiness->internal_image);
        // }
        $this->createNotification(
            auth()->user()->id,
            $newBusiness->id,
            "criou novo empreendimento"
        );
        return response()->json($newBusiness, 201);
    }
    /**
     * Show
     *
     * Lista uma categoria de empreendimento específica
     */
    public function show(Business $business)
    {
        $business->business_tags = $business->tags;
        $business->business_menus = $business->menus;
        $business->business_categories = $business->category;
        foreach ($business->business_menus as $key => $menu) {
            $business->business_menus[$key] = $menu->id;
        }
        foreach ($business->business_tags as $key => $tag) {
            $business->business_tags[$key] = $tag->id;
        }
        foreach ($business->business_categories as $key => $category) {
            $business->business_categories[$key] = $category->id;
        }
        unset($business->tags);
        unset($business->menus);
        unset($business->category);
        if ($business->image) {
            $business->image = asset($business->image);
        }
        if ($business->folder_image) {
            $business->folder_image = asset($business->folder_image);
        }
        if ($business->title_image) {
            $business->title_image = asset($business->title_image);
        }
        if ($business->background_image) {
            $business->background_image = asset($business->background_image);
        }
        // if ($business->internal_image) {
        //     $business->internal_image = asset($business->internal_image);
        // }
        return $business;
    }
    /**
     * Update
     *
     * Atualiza uma empreendimento
     */
    public function update(Request $request, Business $business)
    {
        $data = $request->all();
        $validation = $this->validation($data, 'update');
        if ($validation->fails()) {
            return response()->json(['errors' => $validation->errors()], 406);
        }
        $image = $business->image;
        if ($request->hasFile('image')) {
            if ($uploadedImage = $this->uploadValidFile('business', $data['image'])) {
                $image = $uploadedImage;
                if (!empty($business->image)) {
                    $this->deleteFile($business->image);
                }
            }
        }
        $folderImage = $business->folder_image;
        if ($request->hasFile('folder_image')) {
            if ($uploadedImage = $this->uploadValidFile('business', $data['folder_image'])) {
                $folderImage = $uploadedImage;
                if (!empty($business->folder_image)) {
                    $this->deleteFile($business->folder_image);
                }
            }
        }
        $titleImage = $business->title_image;
        if ($request->hasFile('title_image')) {
            if ($uploadedImage = $this->uploadValidFile('business', $data['title_image'])) {
                $titleImage = $uploadedImage;
                if (!empty($business->title_image)) {
                    $this->deleteFile($business->title_image);
                }
            }
        }
        $backgroundImage = $business->background_image;
        if ($request->hasFile('background_image')) {
            if ($uploadedImage = $this->uploadValidFile('business', $data['background_image'])) {
                $backgroundImage = $uploadedImage;
                if (!empty($business->background_image)) {
                    $this->deleteFile($business->background_image);
                }
            }
        }
        // $internalImage = $business->internal_image;
        // if ($request->hasFile('internal_image')) {
        //     if ($uploadedImage = $this->uploadValidFile('business', $data['internal_image'])) {
        //         $internalImage = $uploadedImage;
        //         if (!empty($business->internal_image)) {
        //             $this->deleteFile($business->internal_image);
        //         }
        //     }
        // }
        
        $data['image'] = $image;
        $data['folder_image'] = $folderImage;
        $data['title_image'] = $titleImage;
        $data['background_image'] = $backgroundImage;
        // $data['internal_image'] = $internalImage;
        $data['slug'] = $this->getSlug($data['title'], 'business_categories');
        $business->update($data);
        if (isset($data['business_categories'])) {
            $business->category()->sync($data['business_categories']);
        }
        if (isset($data['business_tags'])) {
            $business->tags()->sync($data['business_tags']);
        }
        if (isset($data['business_menus'])) {
            $business->menus()->sync($data['business_menus']);
        }
        if ($business->image) {
            $business->image = asset($business->image);
        }
        if ($business->folder_image) {
            $business->folder_image = asset($business->folder_image);
        }
        if ($business->title_image) {
            $business->title_image = asset($business->title_image);
        }
        return response($business, 200);
    }
    /**
     * Delete
     *
     * Remove uma categoria de empreendimento
     */
    public function destroy(Business $business)
    {
        if (!empty($business->image)) {
            $this->deleteFile($business->image);
        }
        if (!empty($business->folder_image)) {
            $this->deleteFile($business->folder_image);
        }
        if (!empty($business->title_image)) {
            $this->deleteFile($business->title_image);
        }
        if (!empty($business->background_image)) {
            $this->deleteFile($business->background_image);
        }
        // if (!empty($business->internal_image)) {
        //     $this->deleteFile($business->internal_image);
        // }
        $business->differentials()->delete();
        $business->tags()->detach();
        $business->menus()->detach();
        $business->category()->detach();
        $this->deleteTickets($business);
        $this->deleteArmorConferences($business);
        $this->destroyConcretingEvent($business);
        $this->deleteFloors($business->floors);
        $this->deletePavements($business);
        $this->deleteUnities($business);
        $this->deleteChecklists($business);
        $business->stages()->delete();
        $business->suroundings()->delete();
        $business->stageGallery()->delete();
        $business->characteristics()->delete();
        $business->delete();
        return response('', 204);
    }
    private function validation(array $data, $function = 'store')
    {
        $validation = [
            'title' => 'required|string|max:100',
            'description' => 'nullable|string',
            'address' => 'required|string|max:180',
            'video' => 'nullable|string|max:50',
            'latitude' => 'required|string|max:25',
            'longitude' => 'required|string|max:25',
            'business_filter_id' => 'required|integer|exists:business_filters,id',
            'neighborhood' => 'required|string|max:100',
            'reference' => 'string|max:250',
            'link_maps' => 'string|max:500',
            'for_sale' => 'required|boolean',
            'delivered' => 'required|boolean'
        ];
        if ($function == 'store') {
            $validation['image'] = 'required|image';
            $validation['title_image'] = 'required|image';
            $validation['background_image'] = 'required|image';
            // $validation['internal_image'] = 'required|image';
            $validation['start_date'] = 'date_format:Y-m-d H:i:s';
            $validation['end_date'] = 'date_format:Y-m-d H:i:s|after:start_date';
        }
        if ($function == 'update') {
            $validation['image'] = 'nullable|image';
            $validation['title_image'] = 'nullable|image';
            // $validation['internal_image'] = 'nullable|image';
            $validation['background_image'] = 'nullable|image';
        }
        return Validator::make($data, $validation);
    }
    /*
    * Se alguém souber uma forma melhor de fazer oq essas funções abaixo fazem, podem refatorar que eu agradeço
    */
    private function deleteFloors($floors)
    {
        foreach ($floors as $floor) {
            $this->deleteApartments($floor->apartments);
            $floor->delete();
        }
        return true;
    }
    private function deleteApartments($apartments)
    {
        foreach ($apartments as $apartment) {
            $this->deleteApartmentRooms($apartment->rooms);
            $this->deleteApartmentFeatures($apartment->features);
            
            if (!empty($apartment->image)) {
                $this->deleteFile($apartment->image);
            }
            $apartment->delete();
        }
        return true;
    }
    private function deleteApartmentRooms($rooms)
    {
        foreach ($rooms as $room) {
            $room->delete();
        }
        return true;
    }
    private function deleteApartmentFeatures($features)
    {
        foreach ($features as $feature) {
            if (!empty($feature->image)) {
                $this->deleteFile($feature->image);
            }
            $feature->delete();
        }
        return true;
    }
    private function deleteTickets($business)
    {
        $business->tickets()->delete();
        return true;
    }
    private function deleteRealStates($business)
    {
        foreach ($business->realStates as $realState) {
            if (!empty($realState->pricing_folder)) {
                $this->deleteFile($realState->pricing_folder);
            }
            if (!empty($realState->garage_folder)) {
                $this->deleteFile($realState->garage_folder);
            }
        }
        
        $business->realStates()->delete();
        return true;
    }
    private function deleteArmorConferences($business)
    {
        $business->armorConferences()->delete();
        return true;
    }
    private function destroyConcretingEvent($business)
    {
        foreach ($business->concretingEvents as $concretingEvent) {
            $this->destroyConcretings($concretingEvent);
            if (!empty($concretingEvent->mapping)) {
                $this->deleteFile($concretingEvent->mapping);
            }
        }
        $business->concretingEvents()->delete();
        return true;
    }
    private function deletePavements($business)
    {
        $business->pavements()->delete();
        return true;
    }
    private function deleteUnities($business)
    {
        $business->unities()->delete();
        return true;
    }
    private function deleteChecklists($business)
    {
        $business->checklists()->delete();
        return true;
    }
    private function destroyConcretings($concreteEvent)
    {
        foreach ($concreteEvent->concretings as $concreting) {
            if (!empty($concreting->file)) {
                $this->deleteFile($concreting->file);
            }
        }
        $concreteEvent->concretings()->delete();
        return true;
    }
    private function listPaginated($filters)
    {
        $businesses = Business::select(
            'businesses.id',
            'slug',
            'title',
            'image',
            'background_image',
            'neighborhood',
            'business_filter_id',
            'for_sale'
        )
            ->leftJoin('business_business_category', 'businesses.id', 'business_business_category.business_id')
            ->where(function ($query) use ($filters) {
                if (!empty($filters['filter'])) {
                    $query->where('business_filter_id', $filters['filter']);
                }
                if (!empty($filters['delivered'])) {
                    $query->where('delivered', $filters['delivered']);
                }
                if (!empty($filters['for_sale']) && $filters['for_sale'] != 'undefined') {
                    $query->where('for_sale', $filters['for_sale']);
                }
                if (!empty($filters['category'])) {
                    $query->where('business_business_category.business_category_id', $filters['category']);
                }
            })
            ->orderBy('businesses.id', 'desc')
            ->groupBy('businesses.id', 'slug')
            ->paginate();
        return $businesses;
    }
    
    private function listNotPaginated($filters)
    {
        $businesses = Business::select(
            'businesses.id',
            'slug',
            'title',
            'image',
            'background_image',
            'neighborhood',
            'business_filter_id',
            'for_sale'
        )
            ->leftJoin('business_business_category', 'businesses.id', 'business_business_category.business_id')
            ->where(function ($query) use ($filters) {
                if (!empty($filters['filter'])) {
                    $query->where('business_filter_id', $filters['filter']);
                }
                if (!empty($filters['delivered'])) {
                    $query->where('delivered', $filters['delivered']);
                }
                if (!empty($filters['for_sale']) && $filters['for_sale'] != 'undefined') {
                    $query->where('for_sale', $filters['for_sale']);
                }
                if (!empty($filters['category'])) {
                    $query->where('business_business_category.business_category_id', $filters['category']);
                }
            })
            ->orderBy('businesses.id', 'desc')
            ->groupBy('businesses.id', 'slug')
            ->get();
        return $businesses;
    }
}