import { Paper, Stack, Typography } from '@mui/material';
import { ChartsAxisContentProps } from '@mui/x-charts/ChartsTooltip';

import { LegendSwatch } from './ChartControls';
import { formatValue, SERIES } from './series';

export default function ChartTooltipContent(
  props: ChartsAxisContentProps
): JSX.Element | null {
  const { axis, axisValue, dataIndex, series } = props;

  if (dataIndex === null || dataIndex === undefined) {
    return null;
  }

  const rows = series.flatMap((item) => {
    const definition = SERIES.list.find((entry) => entry.id === item.id);
    const value = item.data[dataIndex];
    const isKnown = definition !== undefined && typeof value === 'number';

    return isKnown ? [{ definition, value }] : [];
  });

  return (
    <Paper variant='outlined' sx={{ padding: 1.5, minWidth: 220 }}>
      <Typography variant='subtitle2' sx={{ marginBottom: 1 }}>
        {axis.valueFormatter
          ? axis.valueFormatter(axisValue)
          : String(axisValue)}
      </Typography>
      <Stack spacing={0.5}>
        {rows.map(({ definition, value }) => (
          <Stack
            key={definition.id}
            direction='row'
            spacing={1}
            alignItems='center'
          >
            <LegendSwatch color={definition.color} />
            <Typography variant='body2'>{definition.label}</Typography>
            <Typography
              variant='body2'
              sx={{ marginLeft: 'auto', fontWeight: 600 }}
            >
              {formatValue(definition, value)}
            </Typography>
          </Stack>
        ))}
      </Stack>
    </Paper>
  );
}
