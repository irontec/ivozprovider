import { useFormikType } from '@irontec/ivoz-ui';
import { useEffect } from 'react';

import { useStoreState } from '../../../store';

const useDefaultLocation = (edit: boolean, formik: useFormikType) => {
  const defaultLocationId = useStoreState(
    (state) => state.clientSession.aboutMe.profile?.defaultLocationId
  );

  const isUsingDefaultLocation =
    formik.values.useDefaultLocation &&
    formik.values.useDefaultLocation !== '0';
  const locationValue = isUsingDefaultLocation
    ? defaultLocationId
    : formik.initialValues.location;

  const setFieldValue = formik.setFieldValue;

  useEffect(() => {
    if (!edit) {
      return;
    }

    setFieldValue('location', locationValue ?? '__null__');
  }, [edit, locationValue, setFieldValue]);

  return isUsingDefaultLocation;
};

export default useDefaultLocation;
