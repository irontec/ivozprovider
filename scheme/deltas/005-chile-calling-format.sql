-- 1XX0 internacional code
-- 56 country code
-- Number length: 9
-- No area code is used
UPDATE Countries SET e164Pattern='/^(\+|1[0-9][0-9]0)?(?<cc>56)?(?<sn>\d{9})$/' WHERE code='CL';
