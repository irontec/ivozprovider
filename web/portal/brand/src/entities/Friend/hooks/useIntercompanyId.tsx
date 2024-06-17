import { useFormikType } from '@irontec-voip/ivoz-ui';
import useCancelToken from '@irontec-voip/ivoz-ui/hooks/useCancelToken';
import { useEffect, useState } from 'react';

import UnassignedCompanySelectOptions from '../../Company/SelectOptions/CompanyUnassignedSelectOptions';

interface useIntercompanyIdProps {
  edit: boolean | undefined;
  formik: useFormikType;
}

export const useIntercompanyId = (props: useIntercompanyIdProps) => {
  const { edit, formik } = props;
  const [interCompany, setInterCompany] = useState<Record<
    number,
    string
  > | null>(null);
  const [, cancelToken] = useCancelToken();

  const isInterVpbx = formik.values.directConnectivity === 'intervpbx';
  const companyId = formik.values.company;
  const interCompanyId = formik.values.interCompany;

  useEffect(() => {
    const emptyResult: Record<number, string> = {};
    setInterCompany(emptyResult);

    if (!isInterVpbx) {
      return;
    }

    if (!companyId) {
      return;
    }

    const includeId = edit ? interCompanyId : null;

    UnassignedCompanySelectOptions(
      {
        callback: (options: Record<number, string>) => {
          setInterCompany(options || emptyResult);
        },
        cancelToken,
        companyId: companyId as number,
      },
      {
        _includeId: includeId,
      }
    );
  }, [companyId, isInterVpbx, cancelToken]);

  return interCompany;
};
