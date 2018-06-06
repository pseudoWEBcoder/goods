<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'My Yii Application';
?>
<div class="site-index">



    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <h2>загрузить файл</h2>

                <p>залить файл <code>.json</code>формата в базу данных </p>

                <p><?= Html::a('загрузить  файл', ['import/upload'], ['class' => 'btn  btn-success']) ?></p>
            </div>
            <div class="col-lg-4">
                <h2>список залитых </h2>

                <p>список залитых чеков</p>

                <p><?= Html::a('список', ['receipt/index'], ['class' => 'btn  btn-success']) ?></p>
            </div>
            <div class="col-lg-4">
                <h2>админка</h2>

                <p><?php $admin = ['/admin' => '<strong>админка</strong>',
                        '/admin/route' => 'маршруты',
                        '/admin/permission' => 'разрешения',
                        '/admin/menu' => 'меню',
                        '/admin/role' => 'роли',
                        '/admin/assignment' => 'назначения'];
                    array_walk_recursive($admin, function (&$v, $i) {
                        $v = Html::a($v, [$i]);
                    });
                    echo Html::ul($admin, ['encode' => false]) ?></p>
                <div role="presentation" class="dropdown "><a href="#" class="dropdown-toggle btn  btn-link" id="drop4"
                                                              data-toggle="dropdown" role="button" aria-haspopup="true"
                                                              aria-expanded="true"> <i
                                class="glyphicon glyphicon-info-sign"></i> больше .. <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu" id="menu1" aria-labelledby="drop4">

                        <li>
                            <!-- Button trigger modal -->
                            <a href="#" data-toggle="modal" data-target="#modelId">
                                как это работает
                            </a></li>
                        <li role="separator" class="divider"></li>
                        <li><a
                                    href="https://github.com/mdmsoft/yii2-admin/blob/3.master/README.md#upgrade-from-2x"
                                    target="_blank">смотреть на гитхабе &raquo;</a></li>
                    </ul>
                </div>


                <!-- Modal -->
                <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
                     aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <h4 class="modal-title" id="modelTitleId"> как это работает</h4>
                            </div>
                            <div class="modal-body">

                                <div class="alert alert-info">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×
                                    </button>

                                    <div class="panel panel-info">
                                        <div class="panel-heading">
                                            <h3 class="panel-title">как это работает</h3>
                                        </div>
                                        <div class="panel-body">
                                            <ol>
                                                <li>сначала создаем маршрут</li>
                                                <li>потом создаем меню с этим маршрутом</li>
                                                <li>назначаем этот маршрут какой нибудь роли которой он будет доступен
                                                </li>
                                                <li>ну и соответственно назначаем эту роль нужным пользователям</li>
                                            </ol>
                                        </div>
                                    </div>

                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
<?=$this->render('main',  $_params_)?>
    </div>
</div>
