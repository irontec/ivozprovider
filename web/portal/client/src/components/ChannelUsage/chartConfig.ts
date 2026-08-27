import { timestampFormatter } from './dateTime';
import { ChannelUsagePoint } from './types';

export const colors = {
  peak: '#2a78d6',
  average: '#eb6834',
  ok: '#1baf7a',
  blockedByCompany: '#e34948',
  limitLine: '#898781',
};

export const chartSx = {
  '& .MuiAreaElement-root': {
    opacity: 0.15,
  },
  '& .MuiLineElement-series-limit': {
    strokeDasharray: '6 4',
  },
};

const MAX_TICK_LABELS = 8;

interface TimeAxis {
  id: string;
  data: Array<Date>;
  scaleType: 'band';
  valueFormatter: (value: Date) => string;
  tickLabelInterval: (value: Date, index: number) => boolean;
}

export const timeAxis = (
  points: Array<ChannelUsagePoint>,
  rangeMs: number
): TimeAxis => {
  const format = timestampFormatter(rangeMs);
  const labelStep = Math.ceil(points.length / MAX_TICK_LABELS);

  return {
    id: 'time',
    data: points.map((point) => point.timestamp),
    scaleType: 'band',
    valueFormatter: (value: Date) => format(value),
    tickLabelInterval: (value: Date, index: number) => index % labelStep === 0,
  };
};

export const yAxisMax = (values: Array<number>): number =>
  Math.ceil(Math.max(1, ...values) * 1.05) + 1;
