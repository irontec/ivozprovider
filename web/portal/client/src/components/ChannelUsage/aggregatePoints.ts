import { ChannelUsagePoint } from './types';

const BUCKET_MS = 5 * 60 * 1000;
const MAX_CHART_POINTS = 400;

const aggregateGroup = (group: Array<ChannelUsagePoint>): ChannelUsagePoint => {
  const avgUsageSum = group.reduce((sum, point) => sum + point.avgUsage, 0);

  return {
    timestamp: group[0].timestamp,
    peak: Math.max(...group.map((point) => point.peak)),
    avgUsage: avgUsageSum / group.length,
    maxCallsCompany: Math.max(...group.map((point) => point.maxCallsCompany)),
    blockedByCompanyLimit: group.reduce(
      (sum, point) => sum + point.blockedByCompanyLimit,
      0
    ),
  };
};

const aggregatePoints = (
  points: Array<ChannelUsagePoint>,
  rangeMs: number
): Array<ChannelUsagePoint> => {
  const bucketCount = Math.ceil(rangeMs / BUCKET_MS);
  if (bucketCount <= MAX_CHART_POINTS) {
    return points;
  }

  const groupSize = Math.ceil(bucketCount / MAX_CHART_POINTS);
  const groupMs = groupSize * BUCKET_MS;

  const groups = new Map<number, Array<ChannelUsagePoint>>();
  for (const point of points) {
    const groupKey = Math.floor(point.timestamp.getTime() / groupMs);
    const group = groups.get(groupKey) ?? [];
    group.push(point);
    groups.set(groupKey, group);
  }

  return [...groups.values()].map(aggregateGroup);
};

export default aggregatePoints;
