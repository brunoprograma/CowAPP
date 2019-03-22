<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
class Business extends Model
{
    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'slug',
        'title',
        'description',
        'image',
        'address',
        'video',
        'latitude',
        'longitude',
        'start_date',
        'end_date',
        'business_filter_id',
        'business_status_id',
        'neighborhood',
        'reference',
        'center_distance',
        'folder_image',
        'link_maps',
        'featured',
        'title_image',
        'background_image',
        'for_sale',
        'delivered',
        // 'internal_image',
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at',
        'updated_at',
        'pivot'
    ];
    public function category()
    {
        return $this->belongsToMany('App\BusinessCategory');
    }
    public function filter()
    {
        return $this->belongsTo('App\BusinessFilter', 'business_filter_id');
    }
    public function stages()
    {
        return $this->hasMany('App\BusinessStage')->orderBy('order');
    }
    public function stageGallery()
    {
        return $this->hasMany('App\BusinessStageGallery')->orderBy('year', 'desc')->orderBy('month', 'desc');
    }
    public function pictures()
    {
        return $this->hasMany('App\BusinessGalery');
    }
    public function blueprints()
    {
        return $this->hasMany('App\BusinessBlueprint');
    }
    public function floors()
    {
        return $this->hasMany('App\BusinessFloor')->orderBy('id', 'asc');
    }
    public function differentials()
    {
        return $this->hasMany('App\BusinessDifferential');
    }
    public function characteristics()
    {
        return $this->hasMany('App\BusinessCharacteristic');
    }
    public function mainCharacteristics()
    {
        return $this->hasMany('App\BusinessCharacteristic')->where('evidence', 1);
    }
    public function tags()
    {
        return $this->belongsToMany('App\BusinessTag');
    }
    public function menus()
    {
        return $this->belongsToMany('App\BusinessMenu');
    }
    public function suroundings()
    {
        return $this->hasMany('App\BusinessAround');
    }
    public function tickets()
    {
        return $this->hasMany('App\Ticket');
    }
    public function armorConferences(){
        return $this->hasMany('App\ArmorConference');
    }
    public function concretingEvents(){
        return $this->hasMany('App\ConcreteEvent');
    }
    public function pavements(){
        return $this->hasMany('App\BusinessPavement');
    }
    public function unities(){
        return $this->hasMany('App\BusinessUnity');
    }
    public function accompaniments()
    {
        return $this->hasMany('App\Accompaniment');
    }
    public function checklists()
    {
        return $this->hasMany('App\Checklist');
    }
    public function securityFollowups()
    {
        return $this->hasMany('App\SecurityFollowup');
    }
    public function securityFollowupsServices()
    {
        return $this->hasMany('App\SecurityFollowupsServices');
    }
    public function unconformities()
    {
        return $this->hasMany('App\Unconformity');
    }
    public function clientBusinessDeadline()
    {
        return $this->hasMany('App\ClientBusinessDeadline');
    }
    public function saleTable()
    {
        return $this->hasMany('App\SalesTable', 'business_id');
    }
}