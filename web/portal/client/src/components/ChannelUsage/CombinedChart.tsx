import { Box } from '@mui/material';
import { BarPlot } from '@mui/x-charts/BarChart';
import { ChartsAxisHighlight } from '@mui/x-charts/ChartsAxisHighlight';
import { ChartsTooltip } from '@mui/x-charts/ChartsTooltip';
import { ChartsXAxis } from '@mui/x-charts/ChartsXAxis';
import { ChartsYAxis } from '@mui/x-charts/ChartsYAxis';
import { AreaPlot, LinePlot } from '@mui/x-charts/LineChart';
import { ResponsiveChartContainer } from '@mui/x-charts/ResponsiveChartContainer';

import { chartSx, timeAxis, yAxisMax } from './chartConfig';
import ChartPointerLayer from './ChartPointerLayer';
import ChartTooltipContent from './ChartTooltipContent';
import { SERIES, toChartSeries } from './series';
import { ChannelUsagePoint, SeriesId } from './types';

interface CombinedChartProps {
  points: Array<ChannelUsagePoint>;
  rangeMs: number;
  hidden: Array<SeriesId>;
  onRangeSelected: (from: Date, to: Date) => void;
}

export default function CombinedChart(props: CombinedChartProps): JSX.Element {
  const { points, rangeMs, hidden, onRangeSelected } = props;
  const visibleSeries = SERIES.list.filter(
    (definition) => !hidden.includes(definition.id)
  );

  const maxValue = yAxisMax(
    visibleSeries.flatMap((definition) => points.map(definition.value))
  );

  return (
    <Box sx={{ width: '100%', height: 400 }}>
      <ResponsiveChartContainer
        xAxis={[timeAxis(points, rangeMs)]}
        yAxis={[{ id: 'channels', min: 0, max: maxValue }]}
        series={visibleSeries.map((definition) =>
          toChartSeries(definition, points)
        )}
        margin={{ top: 20 }}
        sx={chartSx}
      >
        <BarPlot />
        <AreaPlot />
        <LinePlot />
        <ChartsAxisHighlight x='band' />
        <ChartsXAxis axisId='time' />
        <ChartsYAxis axisId='channels' />
        <ChartsTooltip
          trigger='axis'
          slots={{ axisContent: ChartTooltipContent }}
        />
        <ChartPointerLayer points={points} onRangeSelected={onRangeSelected} />
      </ResponsiveChartContainer>
    </Box>
  );
}
