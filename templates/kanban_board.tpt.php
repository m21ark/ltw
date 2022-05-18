<?php
require_once(__DIR__ . '/../database/Users/concrete_user_factory.class.php');
require_once(__DIR__ . '/../database/restaurant.class.php');
require_once(__DIR__ . '/../database/connection.php');
session_start(); 

function drawKanbanBoard() { ?>
    <div class="kanban">
		<div class="kanban__column">  
			<div class="kanban__column-title">Received</div>
			<div class="kanban__items">
				<div class="kanban__item-input">Wash the dishes</div>
				<div class="kanban__dropzone"></div>
			</div>
		</div>
        <div class="kanban__column">
			<div class="kanban__column-title">Preparing</div>
			<div class="kanban__items">
				<div class="kanban__item-input">Wash the dishes</div>
				<div class="kanban__dropzone"></div>
			</div>
		</div>
        <div class="kanban__column">
			<div class="kanban__column-title">Ready</div>
			<div class="kanban__items">
				<div class="kanban__item-input">Wash the dishes</div>
				<div class="kanban__dropzone"></div>
			</div>
		</div>
	</div>
<?php } ?>


