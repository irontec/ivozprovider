import _ from '@irontec/ivoz-ui/services/translations/translate';
import { Stack, ToggleButton, ToggleButtonGroup } from '@mui/material';
import { DateTimePicker } from '@mui/x-date-pickers/DateTimePicker';

import { RangePreset, TimeRange } from './types';

interface RangeSelectorProps {
  preset: RangePreset;
  onPresetChange: (preset: RangePreset) => void;
  customRange: TimeRange;
  onCustomRangeChange: (range: TimeRange) => void;
  minDate: Date;
}

export default function RangeSelector(props: RangeSelectorProps): JSX.Element {
  const { preset, onPresetChange, customRange, onCustomRangeChange, minDate } =
    props;

  const now = new Date();

  return (
    <Stack
      direction={{ xs: 'column', md: 'row' }}
      spacing={2}
      alignItems={{ xs: 'flex-start', md: 'center' }}
    >
      <ToggleButtonGroup
        value={preset}
        exclusive
        size='small'
        onChange={(event, value: RangePreset | null) => {
          if (value) {
            onPresetChange(value);
          }
        }}
      >
        <ToggleButton value='day'>{_('Last 24 hours')}</ToggleButton>
        <ToggleButton value='week'>{_('Last 7 days')}</ToggleButton>
        <ToggleButton value='month'>{_('Last 30 days')}</ToggleButton>
        <ToggleButton value='custom'>{_('Custom')}</ToggleButton>
      </ToggleButtonGroup>

      {preset === 'custom' && (
        <Stack direction='row' spacing={2}>
          <DateTimePicker
            label={_('From')}
            value={customRange.from}
            minDateTime={minDate}
            maxDateTime={customRange.to}
            ampm={false}
            format='dd/MM/yyyy HH:mm'
            slotProps={{ textField: { size: 'small' } }}
            onChange={(value) => {
              if (value) {
                onCustomRangeChange({ ...customRange, from: value });
              }
            }}
          />
          <DateTimePicker
            label={_('To')}
            value={customRange.to}
            minDateTime={customRange.from}
            maxDateTime={now}
            ampm={false}
            format='dd/MM/yyyy HH:mm'
            slotProps={{ textField: { size: 'small' } }}
            onChange={(value) => {
              if (value) {
                onCustomRangeChange({ ...customRange, to: value });
              }
            }}
          />
        </Stack>
      )}
    </Stack>
  );
}
