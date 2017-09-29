<?php

use yii\helpers\Html;
use yii\helpers\Url;
use funson86\blog\Module;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use funson86\blog\models\BlogCatalog;
use kartik\markdown\MarkdownEditor;
use mihaildev\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model backend\modules\blog\models\BlogPost */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="blog-post-form">

    <?php $form = ActiveForm::begin([
        'options' => ['class' => 'form-horizontal', 'enctype' => 'multipart/form-data'],
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-6\">{input}</div>\n<div class=\"col-lg-2\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-2 control-label'],
        ],
    ]); ?>

    <?= $form->field($model, 'catalog_id')->dropDownList(ArrayHelper::map(BlogCatalog::get(0, BlogCatalog::find()->all()), 'id', 'str_label')) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => 128]) ?>

    <?= $form->field($model, 'brief')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'content')->widget(CKEditor::className(), [
        'editorOptions' => [
            'preset' => 'basic',
            'inline' => false,
        ],
    ]); ?>

    <?= $form->field($model, 'tags')->textInput(['maxlength' => 128]) ?>

    <?= $form->field($model, 'surname')->textInput(['maxlength' => 128]) ?>

    <?= $form->field($model, 'banner')->fileInput() ?>
    <?php if (
        $model->banner !== null
        && is_file(Yii::getAlias('@frontend/web') . DIRECTORY_SEPARATOR . $model->banner)
    ): ?>
        <div class="col-lg-2"></div>
        <div class="col-lg-6"><?= Html::img(Yii::$app->params['frontendBaseUrl'] . $model->banner) ?></div>
        <div class="col-lg-2"></div>
    <?php endif; ?>

    <?= $form->field($model, 'click')->textInput() ?>

    <?= $form->field($model, 'likes')->textInput(['readonly' => true]) ?>
    <?= $form->field($model, 'with_donations')->checkbox() ?>
    <?= $form->field($model, 'amount')->textInput() ?>
    <?= $form->field($model, 'donated')->textInput(['readonly' => true]) ?>
    <?= $form->field($model, 'in_top')->checkbox() ?>

    <?= $form->field($model, 'status')->dropDownList(\funson86\blog\models\Status::labels()) ?>

    <div class="form-group">
        <label class="col-lg-2 control-label" for="">&nbsp;</label>
        <?= Html::submitButton($model->isNewRecord ? Module::t('blog', 'Create') : Module::t('blog', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
