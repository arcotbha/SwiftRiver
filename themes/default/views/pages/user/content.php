<div id="filters-trigger" class="col_12 cf">
	<a href="#" class="button button-primary filters-trigger"><i class="icon-filter"></i>Filters</a>
</div>
			
<section id="filters" class="col_3">
	<div class="modal-window">
		<div class="modal">		
			<div class="modal-title cf">
				<a href="#" class="modal-close button-white"><i class="icon-cancel"></i>Close</a>
				<h1>Filters</h1>
			</div>

			<ul class="filters-primary">
				<li class="active"><a href="#all" class="modal-close"><?php echo __("All your stuff"); ?></a></li>
				<li><a href="#river" class="modal-close"><?php echo __("Rivers"); ?></a></li>
				<li><a href="#bucket" class="modal-close"><?php echo __("Buckets"); ?></a></li>
				<li><a href="#form" class="modal-close"><?php echo __("Forms"); ?></a></li>
			</ul>
            
			<div class="filters-type">
				<h2 class="">Categories</h2>
				<ul>
					<li><a href="#"><span class="mark" style="background-color:red;"></span><span class="total">1</span>Project 1</a></li>
					<li><a href="#"><span class="mark" style="background-color:orange;"></span><span class="total">1</span>Project 2</a></li>
					<li><a href="#"><span class="mark" style="background-color:green;"></span><span class="total">1</span>Project 3</a></li>
				</ul>
			</div>

			<div class="modal-toolbar">
				<a href="#" class="button-submit button-primary modal-close">Done</a>
			</div>
		</div>
	</div>
</section>

<div class="col_9">
	<div class="container base">
		<div class="container-tabs">
			<ul class="container-tabs-menu cf">
				<li class="active"><a href="#all"><?php echo __("All"); ?></a></li>
				<li><a href="#managing"><?php echo __("Managing"); ?></a></li>
				<li><a href="#following"><?php echo __("Following"); ?></a></li>
			</ul>

			<div class="container-toolbar cf">
				<span class="button">
					<a href="#" class="button-white delete-asset"><?php echo __("Delete"); ?></a>
				</span>
				<span class="button" class="button-white">
					<a href="#" class="button-white"><?php echo __("Duplicate"); ?></a>
				</span>
				<?php if ($owner): ?>
				<span class="button create-new">
					<a href="#" class="button-primary modal-trigger">
						<i class="icon-plus"></i>
						<?php echo __("Create new"); ?>
					</a>
				</span>
				<?php endif; ?>
			</div>

			<div class="container-tabs-window">
				<!-- NO RESULTS: Clear filters
				<div class="null-message">
					<h2>No rivers or buckets to show.</h2>
					<p>Clear active filters.</p>
				</div>
				-->

				<table>
					<tbody id="asset-list">
						<!-- List of river, buckets go here -->
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<?php echo $asset_templates; ?>