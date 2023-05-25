import useCancelToken from '@irontec/ivoz-ui/hooks/useCancelToken';
import { useEffect, useState } from 'react';

import { CompanyDdiSelectOptions } from '../../Ddi/SelectOptions';

export const useCompanyDdis = (companyId: number | string | null) => {
  const [ddis, setDdis] = useState<Record<number, string> | null>(null);
  const [, cancelToken] = useCancelToken();

  useEffect(() => {
    setDdis(null);

    if (!companyId || companyId === '__null__') {
      return;
    }

    CompanyDdiSelectOptions(
      {
        callback: (options) => {
          setDdis(options || []);
        },
        cancelToken,
      },
      {
        companyId: companyId as number,
      }
    );
  }, [companyId, cancelToken]);

  return ddis;
};
