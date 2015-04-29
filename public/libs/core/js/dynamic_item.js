function Core_DynamicItem() {}

Core_DynamicItem.prototype =
{
	core_segments: [],
	num_core_segments: 0,

	init: function()
	{
		var self = this;

		$('.core-segment').each(function(core_segment_index, core_segment_element)
		{
			self.core_segments[core_segment_index] =
			{
				index: core_segment_index,
				selector: core_segment_element.getAttribute('id'),
				route: core_segment_element.getAttribute('data-route'),
				loading_html: core_segment_element.innerHTML,
				dynamic_item_options: JSON.parse(core_segment_element.getAttribute('data-options')),
				current_page: 1
			};

			self.num_core_segments++;
		});

		self.initSegments();
	},

	initSegments: function()
	{
		var self = this;

		for ( var core_segment_index = 0; core_segment_index < self.num_core_segments; core_segment_index++ )
		{
			(function(core_segment_index)
			{
				self.refreshSegment(core_segment_index);
			})(core_segment_index);
		}
	},

	refreshSegment: function(core_segment_index)
	{
		var self = this,
			core_segment = self.core_segments[core_segment_index],
			core_segment_element = document.getElementById(core_segment.selector);

		core_segment_element.innerHTML = core_segment.loading_html;

		var ajax_data = {};

		if ( core_segment.dynamic_item_options.paging.enabled === true )
		{
			ajax_data.page = core_segment.current_page;
		}

		$core.ajax.get
		(
			core_segment.route,
			ajax_data,
			{
				success: function(result)
				{
					core_segment_element.innerHTML = result.data.html;

					self.coreSegmentBinds(core_segment_index);
				},
				error: function()
				{
				}
			}
		);
	},

	coreSegmentBinds: function(core_segment_index)
	{
		var self = this,
			core_segment = self.core_segments[core_segment_index];

		if ( core_segment.dynamic_item_options.paging.enabled )
		{
			var $pagination_container = $('#' + core_segment.selector).find('.pagination');

			$pagination_container.find('.prev:not(.disabled)').on('click', function()
			{
				self.core_segments[core_segment_index].current_page--;

				self.refreshSegment(core_segment_index);
			});

			$pagination_container.find('.next:not(.disabled)').on('click', function()
			{
				self.core_segments[core_segment_index].current_page++;

				self.refreshSegment(core_segment_index);
			});
		}
	}
};