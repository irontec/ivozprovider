import useCancelToken from '@irontec/ivoz-ui/hooks/useCancelToken';
import { CompanyDdiSelectOptions } from '../../Ddi/SelectOptions';
import { useState, useEffect } from 'react';

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
        callback: (options: any) => {
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
