import { useState } from 'react';
import { withRouter, RouteComponentProps } from "react-router-dom";
import { FormikHelpers, useFormik } from 'formik';
import { Button } from '@mui/material';
import ErrorMessage from './shared/ErrorMessage';
import EntityService from 'lib/services/entity/EntityService';
import EntityInterface from 'lib/entities/EntityInterface';
import { useFormikType } from 'lib/services/form/types';
import { useStoreActions } from 'easy-peasy';
import _ from 'lib/services/translations/translate';

interface CreateProps extends EntityInterface {
  entityService: EntityService,
  history: any,
  match: any
}

const Create = (props: CreateProps & RouteComponentProps) => {

  const { marshaller, unmarshaller, path, history, properties } = props;
  const { Form: EntityForm, entityService }: { Form: any, entityService: EntityService } = props;
  const [error, setError] = useState(null);
  const apiPost = useStoreActions((actions: any) => {
    return actions.api.post
  });

  const submit = async (values: any, actions: FormikHelpers<any>) => {

    const { setSubmitting } = actions;

    try {

      const payload = marshaller(values, entityService.getColumns());
      const formData = entityService.prepareFormData(payload);

      await apiPost({
        path,
        values: formData,
        contentType: 'application/json',
      });

      setError(null);
      history.push(path);

    } catch (error) {
      console.error(error);
      setError(error.toString());
    } finally {
      setSubmitting(false);
    }
  };

  let initialValues: any = {
    ...entityService.getDefultValues(),
    ...props.initialValues
  }

  for (const idx in properties) {
    if (initialValues[idx] !== undefined) {
      continue;
    }

    initialValues[idx] = '';
  }

  initialValues = unmarshaller(
    initialValues,
    properties
  );

  const formik: useFormikType = useFormik({
    initialValues: initialValues,
    validate: (values: any) => {
      return props.validator(values, props.properties);
    },
    onSubmit: submit,
  });

  return (
    <div>
      <form onSubmit={formik.handleSubmit}>
        <EntityForm formik={formik} create={true} {...props} />
        <br />
        <Button variant="contained" type="submit">
          {_('Save')}
        </Button>
        {error && <ErrorMessage message={error} />}
      </form>
    </div>
  )
};

export default withRouter<any, any>(Create);
