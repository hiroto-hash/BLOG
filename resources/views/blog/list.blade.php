@extends('layout')
@section('title','Blogs')
@section('content')
<div class="row">
  <div class="col-md-10 col-md-offset-2 marbt">
    <h2>ブログ一覧</h2>
    @if (session('err_msg'))
    <p class="test-danger">
      {{session('err_msg')}}
    </p>
    @endif
    <table class="table table-striped">
      <tr>
        <th>記事番号</th>
        <th>タイトル</th>
        <th>日付</th>
        <th></th>
      </tr>
      @foreach($blogs as $blog)
      <tr>
        <td>{{ $blog->id }}</td>
        <td>
          <div class="d-none">
            <div id="modal__content">
              <!-- <a href="/blog/{{ $blog->id }}">{{ $blog->title }}</a> -->
              aaaa
            </div>
          </div>
        </td>
        <td>{{ $blog->updated_at}}</td>
        <td><button type="button" class="btn-primary" onclick="location.href='/blog/edit/{{ $blog->id }}'">編集</button></td>
        <form method="POST" action="{{ route( 'delete', $blog->id ) }}" onSubmit="return checkDelete()">
          @csrf
          <td><button type="submit" class="btn-primary" onclick=>削除</button></td>
      </tr>
      @endforeach
    </table>
    {{ $blogs->links() }}
  </div>
</div>
<style type="text/css">
  /**
* tingle modal modified
**/
  .tingle-modal {
    padding-top: 40px;
    padding-bottom: 40px;
  }

  .tingle-modal-box {
    width: 850px;
    max-width: 90%;
    border-radius: 0;
  }

  .tingle-modal-box__content {
    padding: 0;
  }

  .tingle-modal__close {
    height: 45px;
    width: 48px;
    outline: none !important;
    background-color: rgba(0, 0, 0, .8);
  }

  @media(max-width: 540px) {
    .tingle-modal {
      padding: 20px 15px;
    }

    .tingle-modal-box {
      max-width: 100%;
    }

    .tingle-modal__close {
      font-size: 1.6rem;
      left: auto;
      right: 0px;
      line-height: 1.6rem;
    }

    .tingle-modal__closeIcon {
      font-size: 1.2rem;
      margin-right: 0;
    }

    .tingle-modal__closeLabel {
      display: none;
    }
  }

  @media(min-width: 541px) {
    .tingle-modal__close {
      font-size: 1.2rem;
      top: 20px;
      right: 20px;
    }

    .tingle-modal__closeIcon {
      font-size: 1.2rem;
      margin-right: 0;
    }
  }
</style>
<script src="{{ mix('js/app.js') }}"></script>


@endsection