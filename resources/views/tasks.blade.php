@extends('layouts.app')

@section('content')

    <!-- Bootstrapの定形コード -->
    <div class="container">
        <div class="col-sm-offset-2 col-sm-8">
            <div class="panel panel-default">
                <div class="panel-body">
                    <!-- バリデーションエラーの表示 -->
                    @include('common.errors')

                    <!-- 新タスクフォーム -->
                    <form action="/task" method="POST" class="form-horizontal">
                        {{ csrf_field() }}

                        <!-- タスク名 -->
                        <div class="form-group">
                           <label for="task" class="col-sm-3 control-label">タスク</label>

                           <div class="col-sm-6">
                               <input type="text" name="name" id="task-name" class="form-control">
                           </div>
                        </div>

                        <!-- タスク追加ボタン -->
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-6">
                                <button type="submit" class="btn btn-default">
                                    <i class="fa fa-plus"></i> タスク追加
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- 現在のタスク -->
            @if (count($tasks) > 0)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        現在のタスク
                    </div>

                    <div class="panel-body">
                        <table class="table table-striped task-table">

                            <!-- テーブルヘッダー -->
                            <thead>
                                <th>Task</th>
                                <th>Name</th>
                                <th>&nbsp;</th>
                                <th>&nbsp;</th>
                            </thead>

                            <!-- テーブルボディー -->
                            <tbody>
                                @foreach ($tasks as $task)
                                    <tr>
                                        <!-- タスク名 -->
                                        <td class="table-text">
                                            <div>{{ $task->name }}</div>
                                        </td>

                                        <td class="table-text">
                                            <div>{{ $task->user_name }}</div>
                                        </td>

                                        <td>
                                            <form action="/task_update/{{ $task->id }}" method="POST">
                                                {{ csrf_field() }}
                                                {{ method_field('GET') }}

                                                <button>タスク変更</button>
                                            </form>
                                        </td>

                                        <td>
                                            <!-- 削除ボタン -->
                                            <form action="/task/{{ $task->id }}" method="POST">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}

                                                <button>タスク削除</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
