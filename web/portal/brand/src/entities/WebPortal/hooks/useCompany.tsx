import useCancelToken from '@irontec/ivoz-ui/hooks/useCancelToken';
import CompanySelectOptions, {
  VpbxSelectOptions,
} from 'entities/Company/SelectOptions';
import { useEffect, useState } from 'react';

export const useCompany = (urlType: string) => {
  // const { formik } = props;
  const [companies, setCompanies] = useState<Record<number, string> | null>(
    null
  );
  const [, cancelToken] = useCancelToken();
  //const urlType = formik.values.urlType;

  useEffect(() => {
    const emptyResult: Record<number, string> = {};
    setCompanies(emptyResult);

    const requestParams = {
      callback: (options: Record<number, string>) => {
        setCompanies(options || emptyResult);
      },
      cancelToken,
    };

    switch (urlType) {
      case 'admin':
        CompanySelectOptions(requestParams);
        break;
      case 'user':
        VpbxSelectOptions(requestParams);
        break;
      default:
        return;
    }
  }, [urlType, cancelToken]);

  return companies;
};
