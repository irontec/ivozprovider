export interface ChannelUsageRecord {
  timestamp: string;
  peak: number;
  avgUsage: number;
  maxCallsCompany: number;
  blockedByCompanyLimit: number;
}

export type ChannelUsagePoint = Omit<ChannelUsageRecord, 'timestamp'> & {
  timestamp: Date;
};

export type RangePreset = 'day' | 'week' | 'month' | 'custom';

export interface TimeRange {
  from: Date;
  to: Date;
}

export type SeriesId = 'blocked' | 'peak' | 'average' | 'limit';

export type ChartMode = 'combined' | 'split';
