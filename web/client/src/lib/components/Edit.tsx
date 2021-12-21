import { withRouter, RouteComponentProps } from "react-router-dom";
import { FormikHelpers, useFormik } from 'formik';
import { Button } from '@mui/material';
import ErrorMessage from 'lib/components/shared/ErrorMessage';
import EntityService from 'lib/services/entity/EntityService';
import EntityInterface from 'lib/entities/EntityInterface';
import { useFormikType } from 'lib/services/form/types';
import { useStoreActions, useStoreState } from 'store';
import _ from 'lib/services/translations/translate';
import withRowData from './withRowData';

interface EditProps extends EntityInterface {
  entityService: EntityService,
  history: any,
  match: any,
  row: any,
}

const Edit: any = (props: EditProps & RouteComponentProps) => {

  const { marshaller, unmarshaller, history, match, row } = props;
  const { Form: EntityForm, entityService }: { Form: any, entityService: EntityService } = props;

  const entityId = match.params.id;

  const error = useStoreState((store) => store.api.errorMsg);
  const apiPut = useStoreActions((actions) => actions.api.put);

  const initialValues = unmarshaller(
    row,
    entityService.getProperties()
  );

  const submit = async (values: any, actions: FormikHelpers<any>) => {

    const { setSubmitting } = actions;
    const putPath = entityService.getPutPath();
    if (!putPath) {
      throw new Error('Unknown item path');
    }

    try {

      const payload = marshaller(values, entityService.getColumns());
      const formData = entityService.prepareFormData(payload);

      await apiPut({
        path: putPath.replace('{id}', entityId),
        values: formData
      });

      history.goBack();

    } finally {
      setSubmitting(false);
    }
  };

  const formik: useFormikType = useFormik({
    initialValues,
    validate: (values: any) => {
      return props.validator(values, entityService.getColumns());
    },
    onSubmit: submit,
  });

  return (
    <div>
      <form onSubmit={formik.handleSubmit}>
        <EntityForm formik={formik} edit={true} {...props} />
        <br />
        <Button variant="contained" type="submit">
          {_('Save')}
        </Button>
        {error && <ErrorMessage message={error} />}
      </form>
    </div>
  )
};

export default withRouter<any, any>(
  withRowData(Edit)
);
