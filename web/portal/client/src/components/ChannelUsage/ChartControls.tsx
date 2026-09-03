import _ from '@irontec/ivoz-ui/services/translations/translate';
import {
  Box,
  Chip,
  Stack,
  ToggleButton,
  ToggleButtonGroup,
} from '@mui/material';

import { nextHidden, SERIES } from './series';
import { ChartMode, SeriesId } from './types';

interface LegendSwatchProps {
  color: string;
  size?: number;
}

export function LegendSwatch(props: LegendSwatchProps): JSX.Element {
  const { color, size = 10 } = props;

  return (
    <Box
      component='span'
      sx={{
        display: 'inline-block',
        width: size,
        height: size,
        borderRadius: '2px',
        backgroundColor: color,
      }}
    />
  );
}

interface ViewModeToggleProps {
  mode: ChartMode;
  onModeChange: (mode: ChartMode) => void;
}

export function ViewModeToggle(props: ViewModeToggleProps): JSX.Element {
  const { mode, onModeChange } = props;

  return (
    <ToggleButtonGroup
      value={mode}
      exclusive
      size='small'
      onChange={(event, value: ChartMode | null) => {
        if (value) {
          onModeChange(value);
        }
      }}
    >
      <ToggleButton value='combined'>{_('Combined')}</ToggleButton>
      <ToggleButton value='split'>{_('Split')}</ToggleButton>
    </ToggleButtonGroup>
  );
}

interface ChartLegendProps {
  hidden: Array<SeriesId>;
  onHiddenChange: (hidden: Array<SeriesId>) => void;
}

export function ChartLegend(props: ChartLegendProps): JSX.Element {
  const { hidden, onHiddenChange } = props;

  return (
    <Stack direction='row' flexWrap='wrap' gap={1}>
      {SERIES.list.map((item) => (
        <Chip
          key={item.id}
          size='small'
          variant='outlined'
          clickable
          onClick={(event) =>
            onHiddenChange(
              nextHidden(hidden, item.id, event.metaKey || event.ctrlKey)
            )
          }
          icon={<LegendSwatch color={item.color} size={12} />}
          label={item.label}
          sx={{
            opacity: hidden.includes(item.id) ? 0.35 : 1,
            '& .MuiChip-icon': { marginLeft: '6px' },
          }}
        />
      ))}
    </Stack>
  );
}
