<div class="sidebar">
    <div class='span2 sidebar text-center'>
        <h3>Sidebar</h3>
        <ul class="nav nav-tabs nav-stacked">
            <?php  $categories = \App\Category::where('status', 1)->get();?>
            <?php  $Subcategories = \App\SubCategory::where('status', 1)->get();?>
            @foreach($categories as $category)
                <li><a href='{{url('category/'.$category->id)}}'>{{$category->name }}</a></li>
                @foreach($Subcategories as $Subcategory)
                    @if($Subcategory->category_id == $category->id )
                      <li><a href='{{url('subcategory/'.$Subcategory->id)}}'>-- {{$Subcategory->name }} --</a></li>
                    @endif
                @endforeach
            @endforeach
        </ul>
    </div>
</div>
