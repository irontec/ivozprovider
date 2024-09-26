import {
  DropdownArrayChoice,
  NullablePropertyFkChoices,
  useFormikType,
} from '@irontec/ivoz-ui';
import { useEffect } from 'react';

interface useProxyTrunkProps {
  create?: boolean;
  formik: useFormikType;
  choices?: NullablePropertyFkChoices;
}

export const useDefaultProxyTrunk = (props: useProxyTrunkProps): void => {
  const { create, formik, choices } = props;

  useEffect(() => {
    if (!create) {
      return;
    }

    const hasSingleChoice = choices?.length === 1;
    if (!hasSingleChoice) {
      return;
    }

    if (formik.values.proxyTrunk !== '__null__') {
      return;
    }

    const fkId = (choices[0] as DropdownArrayChoice).id;
    formik.setFieldValue('proxyTrunk', fkId);
  }, [formik, choices, create]);
};
