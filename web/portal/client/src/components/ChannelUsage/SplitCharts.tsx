import { Box, Stack, Typography } from '@mui/material';
import { BarPlot } from '@mui/x-charts/BarChart';
import { ChartsXAxis } from '@mui/x-charts/ChartsXAxis';
import { ChartsYAxis } from '@mui/x-charts/ChartsYAxis';
import { AreaPlot, LinePlot } from '@mui/x-charts/LineChart';
import { ResponsiveChartContainer } from '@mui/x-charts/ResponsiveChartContainer';
import { useState } from 'react';

import { chartSx, timeAxis, yAxisMax } from './chartConfig';
import { LegendSwatch } from './ChartControls';
import ChartPointerLayer from './ChartPointerLayer';
import { timestampFormatter } from './dateTime';
import { formatValue, SERIES, toChartSeries } from './series';
import { ChannelUsagePoint, SeriesId } from './types';

interface SplitChartsProps {
  points: Array<ChannelUsagePoint>;
  rangeMs: number;
  onRangeSelected: (from: Date, to: Date) => void;
}

const PANELS: Array<{ main: SeriesId; reference?: SeriesId }> = [
  { main: 'peak', reference: 'limit' },
  { main: 'average' },
  { main: 'blocked' },
];

export default function SplitCharts(props: SplitChartsProps): JSX.Element {
  const { points, rangeMs, onRangeSelected } = props;
  const [hoverIndex, setHoverIndex] = useState<number | null>(null);

  const formatTimestamp = timestampFormatter(rangeMs);
  const isValidHoverIndex = hoverIndex !== null && hoverIndex < points.length;
  const hovered = isValidHoverIndex ? points[hoverIndex] : null;

  return (
    <Box>
      {PANELS.map((panel) => {
        const main = SERIES.byId[panel.main];
        const reference = panel.reference ? SERIES.byId[panel.reference] : null;
        const panelSeries = [main, ...(reference ? [reference] : [])];
        const hoverText = hovered
          ? [
              formatTimestamp(hovered.timestamp),
              ...panelSeries.map((definition) =>
                formatValue(definition, definition.value(hovered))
              ),
            ].join(' · ')
          : '';

        return (
          <Box key={main.id}>
            <Stack direction='row' spacing={1} alignItems='center'>
              {panelSeries.map((definition) => (
                <Stack
                  key={definition.id}
                  direction='row'
                  spacing={1}
                  alignItems='center'
                >
                  <LegendSwatch color={definition.color} />
                  <Typography variant='caption'>{definition.label}</Typography>
                </Stack>
              ))}
              <Typography
                variant='caption'
                sx={{ marginLeft: 'auto', fontWeight: 600 }}
              >
                {hoverText}
              </Typography>
            </Stack>
            <Box sx={{ width: '100%', height: 135 }}>
              <ResponsiveChartContainer
                xAxis={[timeAxis(points, rangeMs)]}
                yAxis={[
                  {
                    min: 0,
                    max: yAxisMax(
                      panelSeries.flatMap((definition) =>
                        points.map(definition.value)
                      )
                    ),
                  },
                ]}
                series={panelSeries.map((definition) =>
                  toChartSeries(definition, points)
                )}
                margin={{ top: 10, bottom: 24 }}
                sx={chartSx}
              >
                {main.kind === 'bar' ? (
                  <BarPlot />
                ) : (
                  <>
                    <AreaPlot />
                    <LinePlot />
                  </>
                )}
                <ChartsXAxis axisId='time' />
                <ChartsYAxis />
                <ChartPointerLayer
                  points={points}
                  onRangeSelected={onRangeSelected}
                  hoverIndex={hoverIndex}
                  onHoverIndex={setHoverIndex}
                />
              </ResponsiveChartContainer>
            </Box>
          </Box>
        );
      })}
    </Box>
  );
}
