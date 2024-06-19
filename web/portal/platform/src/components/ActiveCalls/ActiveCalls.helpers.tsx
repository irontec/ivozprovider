import { CriteriaFilterValues } from '@irontec/ivoz-ui/components/List/Filter/ContentFilterDialog';

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
      case 'Brand':
        resp.trunks.b = filter.value as string | number;
        break;
      case 'Company':
        resp.trunks.c = filter.value as string | number;
        break;
      case 'Carrier':
        resp.trunks.cr = filter.value as string | number;
        break;
      case 'Direction':
        const requireDdiProvider =
          filter.value === 'inbound' && resp.trunks.dp === undefined;
        const requireCarrier =
          filter.value === 'outbound' && resp.trunks.cr === undefined;

        if (requireDdiProvider) {
          resp.trunks.dp = '*';
        } else if (requireCarrier) {
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
