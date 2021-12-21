import { withRouter, RouteComponentProps } from "react-router-dom";
import { FormikHelpers, useFormik } from 'formik';
import { Button } from '@mui/material';
import ErrorMessage from './shared/ErrorMessage';
import EntityService, { EntityValues } from 'lib/services/entity/EntityService';
import EntityInterface from 'lib/entities/EntityInterface';
import { useFormikType } from 'lib/services/form/types';
import { useStoreActions, useStoreState } from 'store';
import _ from 'lib/services/translations/translate';

interface CreateProps extends EntityInterface {
  entityService: EntityService,
  history: any,
  match: any
}

const Create = (props: CreateProps & RouteComponentProps) => {

  const { marshaller, unmarshaller, path, history, properties } = props;
  const { Form: EntityForm, entityService }: { Form: any, entityService: EntityService } = props;
  const error = useStoreState((store) => store.api.errorMsg);
  const apiPost = useStoreActions((actions) => actions.api.post);

  const submit = async (values: any, actions: FormikHelpers<EntityValues>) => {

    const { setSubmitting } = actions;

    try {

      const payload = marshaller(values, entityService.getColumns());
      const formData = entityService.prepareFormData(payload);

      await apiPost({
        path,
        values: formData,
        contentType: 'application/json',
      });

      history.push(path);

    } finally {
      setSubmitting(false);
    }
  };

  let initialValues: EntityValues = {
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
      return props.validator(values, entityService.getColumns());
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
