import _ from '@irontec/ivoz-ui/services/translations/translate';
import CheckCircleOutlineIcon from '@mui/icons-material/CheckCircleOutline';
import { Box, Stack, Typography } from '@mui/material';
import { useMemo, useState } from 'react';

import aggregatePoints from './aggregatePoints';
import { colors } from './chartConfig';
import { ChartLegend, ViewModeToggle } from './ChartControls';
import CombinedChart from './CombinedChart';
import { DAY_MS } from './dateTime';
import RangeSelector from './RangeSelector';
import SplitCharts from './SplitCharts';
import StatTiles, { StatTile } from './StatTiles';
import { ChartMode, RangePreset, SeriesId, TimeRange } from './types';
import useChannelUsagePoints from './useChannelUsagePoints';

const RETENTION_DAYS = 30;

const presetDays: Record<Exclude<RangePreset, 'custom'>, number> = {
  day: 1,
  week: 7,
  month: 30,
};

const daysAgo = (days: number): Date => new Date(Date.now() - days * DAY_MS);

export default function ChannelUsage(): JSX.Element {
  const [preset, setPreset] = useState<RangePreset>('day');
  const [chartMode, setChartMode] = useState<ChartMode>('combined');
  const [hiddenSeries, setHiddenSeries] = useState<Array<SeriesId>>([]);
  const [customRange, setCustomRange] = useState<TimeRange>(() => ({
    from: daysAgo(1),
    to: new Date(),
  }));

  const range = useMemo<TimeRange>(() => {
    if (preset === 'custom') {
      return customRange;
    }

    return {
      from: daysAgo(presetDays[preset]),
      to: new Date(),
    };
  }, [preset, customRange]);

  const { loading, failed, points } = useChannelUsagePoints(range);

  const rangeMs = range.to.getTime() - range.from.getTime();
  const chartPoints = useMemo(
    () => aggregatePoints(points, rangeMs),
    [points, rangeMs]
  );

  const blockedCalls = points.reduce(
    (sum, point) => sum + point.blockedByCompanyLimit,
    0
  );

  const tiles: Array<StatTile> = (() => {
    if (points.length === 0) {
      return [];
    }

    const maxPeak = Math.max(...points.map((point) => point.peak));
    const avgUsageSum = points.reduce((sum, point) => sum + point.avgUsage, 0);

    return [
      {
        label: _('Max usage'),
        value: String(maxPeak),
        accent: colors.peak,
      },
      {
        label: _('Average usage'),
        value: (avgUsageSum / points.length).toFixed(2),
        accent: colors.average,
      },
      {
        label: _('Blocked calls'),
        value: String(blockedCalls),
        accent: blockedCalls > 0 ? colors.blockedByCompany : colors.ok,
      },
    ];
  })();

  const isSettled = !loading && !failed;
  const isEmpty = isSettled && chartPoints.length === 0;
  const hasData = isSettled && chartPoints.length > 0;

  const zoomTo = (from: Date, to: Date) => {
    setCustomRange({ from, to });
    setPreset('custom');
  };

  return (
    <Box>
      <RangeSelector
        preset={preset}
        onPresetChange={setPreset}
        customRange={customRange}
        onCustomRangeChange={setCustomRange}
        minDate={daysAgo(RETENTION_DAYS)}
      />

      {loading && <Box sx={{ marginTop: 4 }}>{_('Loading')}</Box>}
      {failed && (
        <Box sx={{ marginTop: 4, color: colors.blockedByCompany }}>
          {_('Channel usage data could not be loaded')}
        </Box>
      )}
      {isEmpty && (
        <Box sx={{ marginTop: 4 }}>
          {_('There is no data for the selected period')}
        </Box>
      )}
      {hasData && (
        <>
          <StatTiles tiles={tiles} />

          <Stack
            direction='row'
            flexWrap='wrap'
            justifyContent='center'
            alignItems='center'
            gap={1}
            sx={{ marginTop: 2, marginBottom: 1 }}
          >
            <ViewModeToggle mode={chartMode} onModeChange={setChartMode} />
            {chartMode === 'combined' && (
              <ChartLegend
                hidden={hiddenSeries}
                onHiddenChange={setHiddenSeries}
              />
            )}
          </Stack>

          {chartMode === 'combined' && (
            <CombinedChart
              points={chartPoints}
              rangeMs={rangeMs}
              hidden={hiddenSeries}
              onRangeSelected={zoomTo}
            />
          )}
          {chartMode === 'split' && (
            <SplitCharts
              points={chartPoints}
              rangeMs={rangeMs}
              onRangeSelected={zoomTo}
            />
          )}

          {blockedCalls === 0 && (
            <Stack
              direction='row'
              spacing={1}
              alignItems='center'
              sx={{ marginTop: 2, color: colors.ok }}
            >
              <CheckCircleOutlineIcon fontSize='small' />
              <Typography variant='body2'>
                {_('No calls were blocked in the selected period')}
              </Typography>
            </Stack>
          )}
        </>
      )}
    </Box>
  );
}
