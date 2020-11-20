<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Http\Requests\BlogRequest;

class BlogController extends Controller
{
  /**
   *ブログ一覧を表示する
   *
   * @return view
   */
  public function showList()
  {
    $blogs = Blog::simplePaginate(15);

    return view('blog.list', ['blogs' => $blogs]);
  }
  /** 
   *ブログ詳細を表示する
   * @param int $id
   * @return view
   */
  public function showDetail($id)
  {
    $blog = Blog::find($id);

    if (is_null($blog)) {
      \Session::flash('err_msg', 'データがありません');
      return redirect(route('blogs'));
    }

    return view('blog.detail', ['blog' => $blog]);
  }

  /** 
   *ブログ登録画面表示
   *
   * @return view
   */
  public function showCreate()
  {
    return view('blog.form');
  }
  /** 
   *ブログ登録
   *
   * @return view
   */
  public function exeStore(BlogRequest $request)
  {
    //ブログのデータをうけとる
    $inputs = $request->all();

    \DB::beginTransaction();
    try {
      //ブログを登録
      Blog::create($inputs);
      \DB::commit();
    } catch (\Throwable $e) {
      \DB::rollback;
      abort(500);
    }


    \Session::flash('err_msg', 'ブログを登録しました');
    return redirect(route('blogs'));
  }


  /** 
   *ブログ詳細を表示する
   * @param int $id
   * @return view
   */
  public function showEdit($id)
  {
    $blog = Blog::find($id);

    if (is_null($blog)) {
      \Session::flash('err_msg', 'データがありません');
      return redirect(route('blogs'));
    }

    return view('blog.edit', ['blog' => $blog]);
  }

  /** 
   *ブログ更新
   *
   * @return view
   */
  public function exeUpdate(BlogRequest $request)
  {
    //ブログのデータをうけとる
    $inputs = $request->all();


    \DB::beginTransaction();
    try {
      //ブログを更新
      $blog = Blog::find($inputs['id']);
      $blog->fill(
        [
          'title' => $inputs['title'],
          'content' => $inputs['content'],
        ]
      );
      $blog->save();
      \DB::commit();
    } catch (\Throwable $e) {
      \DB::rollback;
      abort(500);
    }


    \Session::flash('err_msg', 'ブログを更新しました');
    return redirect(route('blogs'));
  }

  /** 
   *ブログ削除
   * @param int $id
   * @return view
   */
  public function exeDelete($id)
  {
    if (empty($id)) {
      \Session::flash('err_msg', 'データがありません');
      return redirect(route('blogs'));
    }
    try {
      //ブログを削除
      Blog::destroy($id);
    } catch (\Throwable $e) {
      abort(500);
    }



    \Session::flash('err_msg', '削除しました');
    return redirect(route('blogs'));
  }
}
