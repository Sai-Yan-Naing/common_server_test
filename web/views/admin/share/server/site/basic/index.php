<?php 
require_once('views/admin/share/header.php');
$error_pages = json_decode($weberrorpages);
 ?>
    <div id="layoutSidenav">
        <?php require_once('views/admin/share/sidebar.php');?>
            <div id="layoutSidenav_content">
            <main class="main-page">
                    <div class="container-fluid px-4">
                            <?php require_once('views/admin/share/title.php') ?>
                            <?php require_once('views/admin/share/server/subtitle.php') ?>
                            <div class="shadow-lg p-3 mb-5 bg-white rounded">
                            <?php require_once("views/admin/share/server/$setting/tab.php") ?>
                                <!-- start -->
                                <div class="tab-content">
                                    <div id="kihon-setting" class="active pr-3 pl-3 tab-pane">
                                        <div class="row mt-5">
                                            <div class="col-sm-2 font-weight-bold">エラーページ</div>
                                            <div class="col-sm-4">
                                                <button class="btn btn-info btn-sm common_dialog" type="button" data-toggle="modal" data-target="#common_modal" gourl="/admin/share/servers/sites/basic?act=new&webid=<?=$webid?>&error_pages"><span class="mr-2"><i class="fas fa-plus-square"></i></span>エラーページ追加</button>
                                            </div>
                                        </div>
                                        <div class="mt-4">
                                            <table class="table table-bordered">
                                                <tr>
                                                    <th>エラーコード</th>
                                                    <th>ファイルパス</th>
                                                    <th>利用設定</th>
                                                </tr>
                                                    <?php
                                                        foreach($error_pages as $key=>$ep) {
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $ep->statuscode; ?></td>
                                                        <td><?php echo $ep->url; ?></td>
                                                        <td>
                                                            <div style="display: -webkit-inline-box;">
                                                                <button edit_id="<?= $key;?>" class="pr-2 btn btn-outline-info btn-sm common_dialog" data-toggle="modal" data-target="#common_modal" gourl="/admin/share/servers/sites/basic?act=edit&webid=<?=$webid?>&error_pages&act_id=<?=$key?>">編集</button>
                                                                <form action="/admin/share/servers/sites/basic?confirm&act=&webid=<?=$webid?>&error_pages&act_id=<?=$key?>" method = "post" class="ml-2">
                                                                    <input type="hidden" name="action" value="onoff">
                                                                    <input type="hidden" name="act_id" value="<?=$key;?>">
                                                                    <label class="switch text-white">
                                                                        <input type="checkbox" <?= $ep->stopped==1? "checked":""  ?>>
                                                                        <span class="slider <?= $ep->stopped==1? "slideron":"slideroff"  ?>"></span>
                                                                        <span class="handle <?= $ep->stopped==1? "handleon":"handleoff"  ?>"></span>
                                                                        <span class="<?= $ep->stopped==1? "labelon":"labeloff"  ?>"><?= $ep->stopped==1? "停止":"起動"  ?></span>
                                                                    </label>
                                                                </form>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                        }
                                                    ?>
                                            </table>
                                        </div>
                                        <div class="row">
                                            <label for="basic-auth" class="col-sm-2 col-form-label font-weight-bold">BASIC認証</label>
                                            <div class="col-sm-4">
                                            <button class="btn btn-info btn-sm common_dialog" type="button" data-toggle="modal" data-target="#common_modal" gourl="/admin/share/servers/sites/basic?act=new&webid=<?=$webid?>&error_pages"><span class="mr-2"><i class="fas fa-plus-square"></i></span>BASIC認証追加</button>
                                            </div>
                                        </div>
                                            <!-- basic setting1 -->
                                            <div id="accordion">
                                                <?php
                                                    $first = 0;
                                                    foreach(json_decode($webbasicsetting) as $main_key => $main_value){
                                                        $first++;
                                                        $key_replace = implode('_',explode('/',$main_key));
                                                ?>
                                                <div class="card">
                                                    <div class="card-header" id="head-<?=$key_replace?>">
                                                        <h5 class="mb-0 d-flex">
                                                            <button class="btn btn-link" data-toggle="collapse" data-target="#collapse-<?=$key_replace?>" aria-expanded="<?= ($first==1)? true:false; ?>" aria-controls="collapse-<?=$key_replace?>">
                                                            BASIC認証設定 <?= $first ?>
                                                            </button>
                                                            <button class="btn btn-sm common_dialog" data-toggle="modal" data-target="#common_modal" gourl="/admin/share/servers/sites/basic?act=delete_dir&act_id=<?=$main_key?>&webid=<?=$webid?>"><i class="fas fa-trash text-danger"></i></button>
                                                        </h5>
                                                    </div>
                                                        <?php $show =($first==1)?"show":"";?>
                                                    <div id="collapse-<?=$key_replace?>" class="collapse <?=$show?>" aria-labelledby="head-<?=$key_replace?>" data-parent="#accordion">
                                                        <div class="card-body">
                                                            <div class="row justify-content-center">
                                                                <div class="col-md-3 border ">対象ディレクトリ</div>
                                                                <div class="col-md-4 border "><?= $main_value->url ?></div>
                                                            </div>
                                                            <div class="mb-2">認証ユーザー</div>
                                                                <table class="table table-bordered">
                                                                    <thead>
                                                                    <tr>
                                                                        <th class="font-weight-bold">ユーザー名</th>
                                                                        <th class="font-weight-bold">パスワード</th>
                                                                        <th class="font-weight-bold">パスワード変更</th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody> 
                                                                    <?php 
                                                                        foreach($main_value->user as $user_key => $user_value){
                                                                    ?>
                                                                    <tr>
                                                                        <td><?= $user_value->bass_user ?></td>
                                                                        <td><?= $user_value->bass_pass ?></td>
                                                                        <td>
                                                                            <button class="btn btn-sm common_dialog" data-toggle="modal" data-target="#common_modal" gourl="/admin/share/servers/sites/basic?act=edit&dir_id=<?=$main_key?>&act_id=<?=$user_key?>&webid=<?=$webid?>"><i class="fas fa-edit text-warning"></i></button>
                                                                            <button class="btn btn-sm common_dialog" data-toggle="modal" data-target="#common_modal" gourl="/admin/share/servers/sites/basic?act=delete&dir_id=<?=$main_key?>&act_id=<?=$user_key?>&webid=<?=$webid?>"><i class="fas fa-trash text-danger"></i></button>
                                                                        </td>
                                                                    </tr>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                    </tbody>
                                                                </table>
                                                                <button class="btn btn-outline-info btn-sm common_dialog" type="button" data-toggle="modal" data-target="#common_modal" gourl="/admin/share/servers/sites/basic?act=new&dir_id=<?=$main_key?>&webid=<?=$webid?>"><span class=""><i class="fas fa-plus"></i></span>User追加</button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php } ?>
                                            </div>
                                            <!-- end basic -->
                                    </div>
                                </div>
                                <!-- end content -->
                            </div>
                    </div>
                </main>
            </div>
        </div> 
 <?php require_once("views/admin/share/footer.php"); ?>
