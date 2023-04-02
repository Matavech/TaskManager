<?php

/**
 * @var array $arResult
 * @var array $arParams
 */

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
?>
<div class="columns mb-6">
	<div class="column">
		<div class="field">
			<div class="control">
				<form action="/" method="get">
				<input class="input" type="text" placeholder="Search for project (isn't working)" name="query">
				</form>
			</div>
		</div>
	</div>
	<div class="column">
		<button class="js-modal-trigger button is-primary is-pulled-right" data-target="modal-js-example">
			Create new task
		</button>
	</div>
</div>

<div class="columns is-flex-wrap-wrap  ">
	<?php
	foreach ($arResult['TASKS'] as $tasks): ?>
		<div class="task-card column is-4">
			<div class="card">
				<header class="card-header">
					<a class="card-header-title" href="/task/<?= $tasks['ID']; ?>/">
						<?= $tasks['TITLE']; ?>
					</a>
				</header>
				<div class="card-content">
					<div class="content">
						<span class="tag priority <?=$tasks['PRIORITY']?>">Приоритет: <?= $tasks['PRIORITY']?></span>
						<br>
						<span class="tag status <?= $tasks['STATUS']?>">Статус: <?= $tasks['STATUS']?></span>
					</div>
				</div>
				<footer class="card-footer">
					<a href="/task/<?= $tasks['ID']; ?>/" class="card-footer-item">View more & Edit</a>
				</footer>
			</div>
		</div>
	<?php
	endforeach; ?>
</div>
<form name="Create Task" action="" method="post">
<div class="modal" id="modal-js-example" >
	<div class="modal-background"></div>
	<div class="modal-card">
		<header class="modal-card-head">
			<p class="modal-card-title">Create new task</p>
			<button class="delete" type="reset" aria-label="close"></button>
		</header>

		<section class="modal-card-body">
			<div class="field">
				<label class="label">Title</label>
				<div class="control">
					<input name="title" class="input is-primary mb-4 is-large" type="text" placeholder="Task title">
				</div>
			</div>
			<div class="field">
				<label class="label">Description</label>
				<div class="control">
					<input name="description" class="input is-primary mb-4 " type="text" placeholder="Task description">
				</div>
			</div>
			<div class="columns" style="margin-bottom:0px">
				<div class="column">
					<label class="label">Deadline</label>
				</div>
				<div class="column">
					<label class="label is-pulled-right">Priority</label>
				</div>
			</div>
			<div class="columns">
				<div class="column">
					<div class="field ">
						<div class="control">
							<input name="deadline" type="date" class="input is-primary mb-4">
						</div>
					</div>
				</div>
				<div class="column">
					<div class="select is-primary is-pulled-right">
						<div class="field">

							<div class="control" >
								<select name="priority">
									<?php foreach (\Up\Tasks\Tasks::getPriorities() as $priority): ?>
									<option value="<?=$priority?>"><?=$priority?></option>
									<?php endforeach;?>
								</select>
							</div>
						</div>
					</div>
				</div>

			</div>
		</section>
		<footer class="modal-card-foot">
			<button class="button is-success" type="submit">Create task</button>
			<button class="button" type="reset" >Cancel</button>
		</footer>
	</div>
</div>
</form>
<script>
	document.addEventListener('DOMContentLoaded', () => {
		// Functions to open and close a modal
		function openModal($el)
		{
			$el.classList.add('is-active');
		}
		function closeModal($el)
		{
			$el.classList.remove('is-active');
		}

		function closeAllModals()
		{
			(document.querySelectorAll('.modal') || []).forEach(($modal) => {
				closeModal($modal);
			});
		}

		// Add a click event on buttons to open a specific modal
		(document.querySelectorAll('.js-modal-trigger') || []).forEach(($trigger) => {
			const modal = $trigger.dataset.target;
			const $target = document.getElementById(modal);

			$trigger.addEventListener('click', () => {
				openModal($target);
			});
		});

		// Add a click event on various child elements to close the parent modal
		(document.querySelectorAll('.modal-background, .modal-close, .modal-card-head .delete, .modal-card-foot .button') || []).forEach(($close) => {
			const $target = $close.closest('.modal');

			$close.addEventListener('click', () => {
				closeModal($target);
			});
		});

		// Add a keyboard event to close all modals
		document.addEventListener('keydown', (event) => {
			const e = event || window.event;

			if (e.keyCode === 27)
			{ // Escape key
				closeAllModals();
			}
		});
	});
</script>
