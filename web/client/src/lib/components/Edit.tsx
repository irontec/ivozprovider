import { useState } from "react";
import { withRouter, RouteComponentProps } from "react-router-dom";
import { useFormik } from 'formik';
import ErrorMessage from 'lib/components/shared/ErrorMessage';
import EntityService from 'lib/services/entity/EntityService';
import EntityInterface from 'lib/entities/EntityInterface';
import { useFormikType } from 'lib/services/form/types';
import { useStoreActions, useStoreState } from 'store';
import withRowData from './withRowData';
import { KeyValList } from "lib/services/api/ParsedApiSpecInterface";
import useCancelToken from "lib/hooks/useCancelToken";
import SaveButton from "./shared/Button/SaveButton";

interface EditProps extends EntityInterface {
  entityService: EntityService,
  history: any,
  match: any,
  row: Record<string, any>,
}

const Edit: any = (props: EditProps & RouteComponentProps) => {

  const { marshaller, unmarshaller, history, match, row, properties, path } = props;
  const { Form: EntityForm, entityService }: { Form: any, entityService: EntityService } = props;

  const entityId = match.params.id;

  const reqError = useStoreState((store) => store.api.errorMsg);
  const apiPut = useStoreActions((actions) => actions.api.put);
  const [, cancelToken] = useCancelToken();
  const [validationError, setValidationError] = useState<KeyValList>({});

  const initialValues = unmarshaller(
    row,
    properties
  );

  const submit = async (values: any) => {

    const putPath = entityService.getPutPath();
    if (!putPath) {
      throw new Error('Unknown item path');
    }

    const payload = marshaller(values, properties);
    const formData = entityService.prepareFormData(payload);

    try {
      const resp = await apiPut({
        path: putPath.replace('{id}', entityId),
        values: formData,
        cancelToken
      });

      if (resp !== undefined) {
        history.push(path);
      }

    } catch {}
  };

  const formik: useFormikType = useFormik({
    initialValues,
    validate: (values: any) => {

      const visualToggles = entityService.getVisualToggles(values);

      const validationErrors = props.validator(
        values,
        properties,
        visualToggles
      );
      setValidationError(validationErrors);

      return validationErrors;
    },
    onSubmit: submit,
  });

  const errorList: { [k: string]: JSX.Element } = {};
  for (const idx in validationError) {

    if (!formik.touched[idx]) {
      continue;
    }

    errorList[idx] = (
      <li key={idx}>{properties[idx].label}: {validationError[idx]}</li>
    );
  }

  return (
    <div>
      <form onSubmit={formik.handleSubmit}>
        <EntityForm  {...props} formik={formik} edit={true} validationErrors={errorList} />
        <SaveButton />
        {reqError && <ErrorMessage message={reqError} />}
      </form>
    </div>
  )
};

export default withRouter<any, any>(
  withRowData(Edit)
);
