<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;


$this->title = 'Countries';
?>

<h2 class="page-header"><?= Html::encode($this->title) ?></h2>
<?php if (Yii::$app->user->can("admin")):?>
    <p>
        <?= Html::a('Create Country', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php endif;?>
<table class="table table-bordered table-striped">
	<thead>
		<th>Code</th>
		<th>Name</th>
		<th>Population</th>
		<th></th>
	</thead>
	<tbody>
		<?php foreach($countries as $country):?>
			<tr>
				<td><?php echo Html::encode($country->code) ?></td>
				<td><?php echo Html::encode($country->name) ?></td>
				<td><?php echo $country->population ?></td>
				<td>
				<?php echo Html::a('<span class="glyphicon glyphicon-eye-open"></span>',['view', 'id' => $country->code])?>
				<?php if (Yii::$app->user->can("admin")):?>
				<?php echo Html::a('<span class="glyphicon glyphicon-pencil"></span>',['update', 'id' => $country->code])?>
				<?=Html::a('<span class="glyphicon glyphicon-trash"></span>', ['delete', 'id' => $country->code], [
					    'data' => [
					        'confirm' => 'Are you sure you want to delete?',
					        'method' => 'post',
					    ]
					])?>
				<?php endif;?>
				</td>
			</tr>
		<?php endforeach;?>
	</tbody>
</table>

<?php echo LinkPager::widget(['pagination' => $pagination])?>