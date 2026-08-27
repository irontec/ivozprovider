export const DAY_MS = 24 * 60 * 60 * 1000;

const twoDigits = (value: number): string => String(value).padStart(2, '0');

export const toApiDateTime = (date: Date): string =>
  `${date.getFullYear()}-${twoDigits(date.getMonth() + 1)}-${twoDigits(
    date.getDate()
  )} ${twoDigits(date.getHours())}:${twoDigits(date.getMinutes())}:${twoDigits(
    date.getSeconds()
  )}`;

export const parseApiDateTime = (value: string): Date =>
  new Date(value.replace(' ', 'T'));

const formatTime = (date: Date): string =>
  `${twoDigits(date.getHours())}:${twoDigits(date.getMinutes())}`;

const formatDayTime = (date: Date): string =>
  `${twoDigits(date.getDate())}/${twoDigits(date.getMonth() + 1)} ${formatTime(
    date
  )}`;

export const timestampFormatter = (rangeMs: number): ((date: Date) => string) =>
  rangeMs <= DAY_MS ? formatTime : formatDayTime;
