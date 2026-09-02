import _ from '@irontec/ivoz-ui/services/translations/translate';
import { BarSeriesType, LineSeriesType } from '@mui/x-charts/models';
import { ReactNode } from 'react';

import { colors } from './chartConfig';
import { ChannelUsagePoint, SeriesId } from './types';

type SeriesKind = 'bar' | 'area' | 'line' | 'reference';

export interface SeriesDefinition {
  id: SeriesId;
  label: ReactNode;
  color: string;
  kind: SeriesKind;
  value: (point: ChannelUsagePoint) => number;
  format?: (value: number) => string;
}

export const DATA_SERIES_IDS: Array<SeriesId> = ['blocked', 'peak', 'average'];
export const REFERENCE_SERIES_ID: SeriesId = 'limit';

const blocked: SeriesDefinition = {
  id: 'blocked',
  label: _('Blocked by client limit'),
  color: colors.blockedByCompany,
  kind: 'bar',
  value: (point) => point.blockedByCompanyLimit,
};
const peak: SeriesDefinition = {
  id: 'peak',
  label: _('Max usage'),
  color: colors.peak,
  kind: 'area',
  value: (point) => point.peak,
};
const average: SeriesDefinition = {
  id: 'average',
  label: _('Average usage'),
  color: colors.average,
  kind: 'line',
  value: (point) => point.avgUsage,
  format: (value) => value.toFixed(2),
};
const limit: SeriesDefinition = {
  id: 'limit',
  label: _('Channel limit'),
  color: colors.limitLine,
  kind: 'reference',
  value: (point) => point.maxCallsCompany,
};

export const SERIES = {
  list: [blocked, peak, average, limit],
  byId: { blocked, peak, average, limit },
};

export const formatValue = (
  definition: SeriesDefinition,
  value: number
): string => (definition.format ? definition.format(value) : String(value));

export const toChartSeries = (
  definition: SeriesDefinition,
  points: Array<ChannelUsagePoint>
): BarSeriesType | LineSeriesType => {
  const base = {
    id: definition.id,
    data: points.map(definition.value),
    color: definition.color,
  };

  if (definition.kind === 'bar') {
    return { ...base, type: 'bar' };
  }

  const curve: LineSeriesType['curve'] =
    definition.kind === 'reference' ? 'stepAfter' : 'linear';

  return {
    ...base,
    type: 'line',
    area: definition.kind === 'area',
    curve,
  };
};

const ALL_SERIES_IDS: Array<SeriesId> = [
  ...DATA_SERIES_IDS,
  REFERENCE_SERIES_ID,
];

export const nextHidden = (
  hidden: Array<SeriesId>,
  id: SeriesId,
  toggleOne: boolean
): Array<SeriesId> => {
  const isVisible = (seriesId: SeriesId) => !hidden.includes(seriesId);
  const toggled = isVisible(id)
    ? [...hidden, id]
    : hidden.filter((hiddenId) => hiddenId !== id);

  if (toggleOne) {
    const isLastVisible =
      isVisible(id) && hidden.length === ALL_SERIES_IDS.length - 1;

    return isLastVisible ? hidden : toggled;
  }

  if (id === REFERENCE_SERIES_ID) {
    return toggled;
  }

  const othersHidden = DATA_SERIES_IDS.filter((seriesId) => seriesId !== id);
  const isSolo =
    isVisible(id) &&
    othersHidden.every((seriesId) => hidden.includes(seriesId));

  return isSolo ? [] : othersHidden;
};
