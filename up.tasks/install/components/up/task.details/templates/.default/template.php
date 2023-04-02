<?php

/**
 * @var array $arResult
 * @var array $arParams
 */

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
?>
<form method="post" action="" name="Update task">
<section class="hero is-link">
	<div class="hero-body px-2 py-2">
		<input type="hidden" name="ID" value="<?=$arResult['task']['ID']?>">
		<p>
			<input name="TITLE" class="input-title is-fullwidth" type="text" placeholder="Link input" value="<?= $arResult['task']['TITLE'] ?>">
		</p>
		<p>
			<textarea name="DESCRIPTION" rows="5" class="input-desk is-fullwidth ml-3" type="text" placeholder="Link input"><?= $arResult['task']['DESCRIPTION'] ?></textarea>
		</p>
	</div>
</section>
<br>
<nav class="level">
	<div class="level-item has-text-centered">
		<div>
			<p class="heading">Date creation</p>
			<p class="title" name="DATE_CREATION">
				<?= $arResult['task']['DATE_CREATION']->format('d.m.Y')?>
			</p>
		</div>
	</div>
	<div class="level-item has-text-centered">
		<div>
			<p class="heading">Priority</p>
			<p class="select is-link" name="PRIORITY">
				<select class='select is-link' name='Priority'>
					<?php foreach (\Up\Tasks\Tasks::getPriorities() as $priority) : ?>
						<option <?= $arResult['task']['PRIORITY'] === $priority ? 'selected' : '' ?> value="<?= $priority ?>"><?= $priority ?></option>
					<?php endforeach ?>
				</select>
			</p>
		</div>
	</div>
	<div class="level-item has-text-centered">
		<div>
			<p class="heading">Status</p>

			<p class="select is-link" name="STATUS">
				<select class='select is-link' name='Status'>
					<?php foreach (\Up\Tasks\Tasks::getStatuses() as $status) : ?>
						<option <?= $arResult['task']['STATUS'] === $status ? 'selected' : '' ?> value="<?= $status ?>"><?= $status ?></option>
					<?php endforeach ?>
				</select>
			</p>
		</div>
	</div>
	<div class="level-item has-text-centered">
		<div class="control">
			<div class="heading">Deadline
				<input name="DATE_DEADLINE" type="date" class="input is-link" value="<?= $arResult['task']['DATE_DEADLINE'] ? $arResult['task']['DATE_DEADLINE']->format('Y-m-d') : 'null' ?>">
			</div>
		</div>
	</div>

</nav>
<div class="buttons is-justify-content-center">
	<button class="button is-success" type="submit">Save</button>
</form>
<form action="/delete/" method="post">
	<button name="id" value="<?= $arResult['task']['ID']?>" class="button is-danger" type="submit" onclick="return confirm('Are you sure you want to delete this task?')">Delete task</button>
</form>
</div>
