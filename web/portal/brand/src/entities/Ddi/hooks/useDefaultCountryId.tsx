import { useFormikType } from '@irontec/ivoz-ui';
import { CompanyPropertyList } from 'entities/Company/CompanyProperties';
import { useEffect } from 'react';
import { useStoreActions } from 'store';

import Company from '../../Company/Company';
import { CountryPropertyList } from '../../Country/CountryProperties';

interface useDefaultCountryIdProps {
  create: boolean | undefined;
  formik: useFormikType;
}

const useDefaultCountryId = (props: useDefaultCountryIdProps): void => {
  const { create, formik } = props;

  const apiGet = useStoreActions((actions) => {
    return actions.api.get;
  });

  const companyId = formik.values.company;

  useEffect(() => {
    if (!create) {
      return;
    }

    if (!companyId) {
      return;
    }

    apiGet({
      path: `${Company.path}/${companyId}`,
      params: {
        _properties: ['country'],
      },
      successCallback: async (data) => {
        const countryId = (data as CompanyPropertyList).country
          .id as CountryPropertyList<number>;
        formik.setFieldValue('country', countryId);
      },
    });
  }, [create, companyId, apiGet]);
};

export default useDefaultCountryId;
