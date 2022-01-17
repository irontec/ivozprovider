import { useState } from "react";
import { withRouter, RouteComponentProps } from "react-router-dom";
import { FormikHelpers, useFormik } from 'formik';
import { Alert, AlertTitle, Button } from '@mui/material';
import ErrorMessage from './shared/ErrorMessage';
import EntityService, { EntityValues } from 'lib/services/entity/EntityService';
import EntityInterface from 'lib/entities/EntityInterface';
import { useFormikType } from 'lib/services/form/types';
import { useStoreActions, useStoreState } from 'store';
import _ from 'lib/services/translations/translate';
import { KeyValList, ScalarProperty } from "lib/services/api/ParsedApiSpecInterface";

interface CreateProps extends EntityInterface {
  entityService: EntityService,
  history: any,
  match: any
}

const Create = (props: CreateProps & RouteComponentProps) => {

  const { marshaller, unmarshaller, path, history, properties } = props;
  const { Form: EntityForm, entityService }: { Form: any, entityService: EntityService } = props;
  const reqError = useStoreState((store) => store.api.errorMsg);
  const [validationError, setValidationError] = useState<KeyValList>({});
  const apiPost = useStoreActions((actions) => actions.api.post);
  const columns = entityService.getProperties();

  const submit = async (values: any, actions: FormikHelpers<EntityValues>) => {

    const { setSubmitting } = actions;

    try {

      const payload = marshaller(values, columns);
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

    const isBoolean = (columns[idx] as ScalarProperty)?.type === 'boolean';
    initialValues[idx] = isBoolean
      ? 0
      : '';
  }

  initialValues = unmarshaller(
    initialValues,
    properties
  );

  const formik: useFormikType = useFormik({
    initialValues: initialValues,
    validate: (values: any) => {
      const validationErrors = props.validator(values, columns);
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
      <li key={idx}>{columns[idx].label}: {validationError[idx]}</li>
    );
  }

  return (
    <div>
      <form onSubmit={formik.handleSubmit}>
        <EntityForm formik={formik} create={true} {...props} />
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

export default withRouter<any, any>(Create);
