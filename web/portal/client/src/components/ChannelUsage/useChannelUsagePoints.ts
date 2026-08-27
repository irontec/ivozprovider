import useCancelToken from '@irontec/ivoz-ui/hooks/useCancelToken';
import { useEffect, useState } from 'react';
import { useStoreActions } from 'store';

import { parseApiDateTime, toApiDateTime } from './dateTime';
import { ChannelUsagePoint, ChannelUsageRecord, TimeRange } from './types';

const isChannelUsageRecord = (value: unknown): value is ChannelUsageRecord =>
  typeof value === 'object' &&
  value !== null &&
  'timestamp' in value &&
  'peak' in value;

const toPoint = (record: ChannelUsageRecord): ChannelUsagePoint => ({
  timestamp: parseApiDateTime(record.timestamp),
  peak: record.peak,
  avgUsage: record.avgUsage,
  maxCallsCompany: record.maxCallsCompany,
  blockedByCompanyLimit: record.blockedByCompanyLimit,
});

interface ChannelUsagePoints {
  loading: boolean;
  failed: boolean;
  points: Array<ChannelUsagePoint>;
}

const useChannelUsagePoints = (range: TimeRange): ChannelUsagePoints => {
  const [loading, setLoading] = useState(true);
  const [failed, setFailed] = useState(false);
  const [points, setPoints] = useState<Array<ChannelUsagePoint>>([]);
  const apiGet = useStoreActions((store) => store.api.get);
  const [, cancelToken] = useCancelToken();

  const { from, to } = range;

  useEffect(() => {
    let active = true;
    let loaded = false;

    setLoading(true);
    setFailed(false);

    apiGet({
      path: '/channel_usages',
      params: {
        'timestamp[after]': toApiDateTime(from),
        'timestamp[before]': toApiDateTime(to),
        '_order[timestamp]': 'ASC',
        _pagination: false,
      },
      cancelToken: cancelToken,
      successCallback: async (response) => {
        if (!active) {
          return;
        }

        if (!Array.isArray(response)) {
          return;
        }

        setPoints(response.filter(isChannelUsageRecord).map(toPoint));
        loaded = true;
      },
    })
      .catch(() => undefined)
      .finally(() => {
        if (!active) {
          return;
        }

        setFailed(!loaded);
        setLoading(false);
      });

    return () => {
      active = false;
    };
  }, [apiGet, cancelToken, from, to]);

  return { loading, failed, points };
};

export default useChannelUsagePoints;
