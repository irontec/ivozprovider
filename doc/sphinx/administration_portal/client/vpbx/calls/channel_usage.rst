#############
Channel usage
#############

This section shows **historical channel usage** of the client, built from 5-minute samples and kept for the last
**30 days**.

The time range can be selected using the preset buttons (*Last 24 hours*, *Last 7 days*, *Last 30 days*) or choosing
a custom range within the retention window. Dragging over the graph also zooms into the selected interval: the range
switches to *Custom* with the dragged limits, which can then be fine-tuned in the date pickers.

The cards on top summarise the selected range: the highest usage, the average usage and the number of blocked calls.

The graph shows:

    Max usage
        Highest number of simultaneous channels in use during each interval.

    Average usage
        Average number of channels in use during each interval.

    Channel limit
        Maximum number of concurrent calls allowed for the client, drawn as a dashed reference line. If the limit
        changed during the range, the line steps at that moment.

    Blocked calls
        Calls rejected for exceeding the client channel limit.

Two views are available:

    Combined
        Everything in one graph. Hovering shows the values of every series at that moment. Clicking a legend entry
        shows only that series, keeping the channel limit as reference (click it again to restore all); Ctrl/Cmd +
        click toggles series one by one, the channel limit included.

    Split
        One panel per series (max usage with the channel limit as reference, average usage and blocked calls) sharing
        the same time axis: hovering a panel marks the same moment in all of them, showing each value.

.. note:: Long ranges group several samples per point to keep the graph readable: max usage shows the highest value
          of the group, average usage the mean and blocked calls the sum. Times are shown in the timezone of the
          logged administrator.
