@extends('layouts.admin')
@section('title', 'Quản lý bài viết')
@section('content')

<div class="box-body table-responsive no-padding">
  <div class="row">
    <form action="{{route('post.list')}}" method="get" >
      <div class="col-md-3 form-group">
        <select class="form-control" name="cate">
          <option value="">Select All Category</option>
          @foreach ($cates as $element)
            @php
              $selected = $element->id == $searchCateId ? "selected" : "";
            @endphp
            <option {{$selected}} value="{{$element->id}}">{{$element->name}}</option>
            
          @endforeach
        </select>
      </div> 
      <div class="col-md-5 form-group">
        <div class="col-md-10 relative">
          <input type="text" name="keyword" class="form-control" placeholder="Finding here...." value="{{$searchKeyword}}">
          <button type="submit" class="add-on-input btn btn-sm btn-success">
            <i class="fa fa-search" aria-hidden="true"></i>
          </button>
        </div>
      </div>  
      
    </form>
  </div>
  <table class="table table-hover">
    <tbody>
    <tr>
      <th>ID</th>
      <th>Ảnh bài viết</th>
      <th width="400">Tên bài viết</th>
      <th>Tên danh mục</th>
      <th>
        <a href="{{route('post.add-new')}}" class="btn btn-success btn-xs">
          <i class="fa fa-plus"></i> Add new
        </a>
      </th>
    </tr>
    @foreach ($posts as $element)
      
    	<tr>
	      <td>{{$element->id}}</td>
        <td>
          <img src="{{$element->feature_image}}" width="100">
        </td>
	      <td>{{$element->title}}</td>
	      <td>{{$element->parentName()}}</td>
	      <td>
	      	<a href="{{ route('cate.update', ['id' => $element->id]) }}" class="btn btn-info btn-xs">
	      		<i class="fa fa-pencil"></i> Update
	      	</a>
	      	<a href="{{route('post.destroy', ['id' => $element->id])}}" class="btn btn-danger btn-xs">
	      		<i class="fa fa-remove"></i> Remove
	      	</a>
	      </td>
	    </tr>
    @endforeach
    <tr>
      <td colspan=5 class="text-center">
        {!! $posts->links() !!}
      </td>
    </tr>
  </tbody>
  </table>
</div>
@endsection