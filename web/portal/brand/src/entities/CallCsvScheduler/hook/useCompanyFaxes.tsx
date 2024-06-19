import useCancelToken from '@irontec/ivoz-ui/hooks/useCancelToken';
import { useEffect, useState } from 'react';

import { CompanyFaxSelectOptions } from '../../Fax/SelectOptions';

export const useCompanyFaxes = (companyId: number | string | null) => {
  const [faxes, setFaxes] = useState<Record<number, string> | null>(null);
  const [, cancelToken] = useCancelToken();

  useEffect(() => {
    setFaxes(null);

    if (!companyId || companyId === '__null__') {
      return;
    }

    CompanyFaxSelectOptions(
      {
        callback: (options) => {
          setFaxes(options || []);
        },
        cancelToken,
      },
      {
        companyId: companyId as number,
      }
    );
  }, [companyId, cancelToken]);

  return faxes;
};
