import useCancelToken from '@irontec/ivoz-ui/hooks/useCancelToken';
import { useState, useEffect } from 'react';
import CompanyRetailAccountSelectOptions from '../..//RetailAccount/SelectOptions/CompanyRetailAccountSelectOptions';

export const useCompanyRetailAccount = (companyId: number | string | null) => {
  const [retailAccounts, setRetailAccounts] = useState<Record<
    number,
    string
  > | null>(null);
  const [, cancelToken] = useCancelToken();

  useEffect(() => {
    setRetailAccounts(null);

    if (!companyId || companyId === '__null__') {
      return;
    }

    CompanyRetailAccountSelectOptions(
      {
        callback: (options: any) => {
          setRetailAccounts(options || []);
        },
        cancelToken,
      },
      {
        companyId: companyId as number,
      }
    );
  }, [companyId, cancelToken]);

  return retailAccounts;
};
