import { CriteriaFilterValues } from '@irontec-voip/ivoz-ui/components/List/Filter/ContentFilterDialog';

import { WsFilters } from './types';

export function queryStringCriteriaToFilters(
  queryStringCriteria: CriteriaFilterValues
): WsFilters {
  if (!queryStringCriteria.length) {
    return null;
  }

  const resp: WsFilters = {
    trunks: {},
  };

  for (const idx in queryStringCriteria) {
    const filter = queryStringCriteria[idx];
    switch (filter.name) {
      case 'Company':
        resp.trunks.c = filter.value as string | number;
        break;
      case 'Carrier':
        resp.trunks.cr = filter.value as string | number;
        break;
      case 'Direction':
        if (filter.value === 'inbound') {
          resp.trunks.dp = '*';
        } else if (filter.value === 'outbound') {
          resp.trunks.cr = '*';
        }
        break;
      case 'DdiProvider':
        resp.trunks.dp = filter.value as string | number;
        break;
    }
  }

  return resp;
}
