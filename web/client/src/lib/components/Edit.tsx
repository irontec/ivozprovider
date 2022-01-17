import { useState } from "react";
import { withRouter, RouteComponentProps } from "react-router-dom";
import { FormikHelpers, useFormik } from 'formik';
import { Alert, AlertTitle, Button } from '@mui/material';
import ErrorMessage from 'lib/components/shared/ErrorMessage';
import EntityService from 'lib/services/entity/EntityService';
import EntityInterface from 'lib/entities/EntityInterface';
import { useFormikType } from 'lib/services/form/types';
import { useStoreActions, useStoreState } from 'store';
import _ from 'lib/services/translations/translate';
import withRowData from './withRowData';
import { KeyValList } from "lib/services/api/ParsedApiSpecInterface";

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

  const reqError = useStoreState((store) => store.api.errorMsg);
  const apiPut = useStoreActions((actions) => actions.api.put);
  const [validationError, setValidationError] = useState<KeyValList>({});

  const properties = entityService.getProperties();
  const initialValues = unmarshaller(
    row,
    properties
  );

  const submit = async (values: any, actions: FormikHelpers<any>) => {

    const { setSubmitting } = actions;
    const putPath = entityService.getPutPath();
    if (!putPath) {
      throw new Error('Unknown item path');
    }

    try {

      const payload = marshaller(values, properties);
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
      const validationErrors = props.validator(values, properties);
      setValidationError(validationErrors);

      return validationErrors;
    },
    onSubmit: submit,
  });

  const errorList: {[k: string]: JSX.Element} = {};
  for (const idx in validationError) {

    if (! formik.touched[idx]) {
      continue;
    }

    errorList[idx] = (
      <li>{properties[idx].label}: {validationError[idx]}</li>
    );
  }

  return (
    <div>
      <form onSubmit={formik.handleSubmit}>
        <EntityForm formik={formik} edit={true} {...props} />
        <br />
        {Object.keys(errorList).length > 0 && (
          <Alert severity="error">
            <AlertTitle>{_("Validation error")}</AlertTitle>
            <ul>{Object.values(errorList).map((error) => error)}</ul>
          </Alert>
        )}
        <Button variant="contained" type="submit">
          {_('Save')}
        </Button>
        {reqError && <ErrorMessage message={reqError} />}
      </form>
    </div>
  )
};

export default withRouter<any, any>(
  withRowData(Edit)
);
