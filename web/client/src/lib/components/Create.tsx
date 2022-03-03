import { useState } from "react";
import { withRouter, RouteComponentProps } from "react-router-dom";
import { useFormik } from 'formik';
import ErrorMessage from './shared/ErrorMessage';
import EntityService, { EntityValues } from 'lib/services/entity/EntityService';
import EntityInterface from 'lib/entities/EntityInterface';
import { useFormikType } from 'lib/services/form/types';
import { useStoreActions, useStoreState } from 'store';
import { KeyValList, ScalarProperty } from "lib/services/api/ParsedApiSpecInterface";
import useCancelToken from "lib/hooks/useCancelToken";
import SaveButton from "./shared/Button/SaveButton";
import findRoute from "lib/router/findRoute";
import { RouteMap } from 'lib/router/routeMapParser';
import { EntityFormType } from "lib/entities/DefaultEntityBehavior";

type CreateProps = RouteComponentProps<Record<string, string>> & EntityInterface & {
  entityService: EntityService,
  routeMap: RouteMap,
  Form: EntityFormType,
}

const Create = (props: CreateProps & RouteComponentProps) => {

  const {
    marshaller, unmarshaller, path, history, properties, routeMap, match, entityService
  } = props;

  const parentRoute = findRoute(routeMap, match);
  let returnPath = parentRoute?.route || '';
  for (const idx in match.params) {
    returnPath = returnPath.replace(`:${idx}`, match.params[idx]);
  }

  const { Form: EntityForm } = props;
  const reqError = useStoreState((store) => store.api.errorMsg);
  const [validationError, setValidationError] = useState<KeyValList>({});
  const apiPost = useStoreActions((actions) => actions.api.post);
  const [, cancelToken] = useCancelToken();

  const columns = entityService.getProperties();

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
    initialValues,
    validate: (values: any) => {

      if (parentRoute?.filterBy) {
        values[parentRoute.filterBy] = Object.values(match.params).pop();
      }

      const visualToggles = entityService.getVisualToggles(values);

      const validationErrors = props.validator(
        values,
        columns,
        visualToggles
      );
      setValidationError(validationErrors);

      return validationErrors;
    },
    onSubmit: async (values: any) => {

      const payload = marshaller(values, columns);
      const formData = entityService.prepareFormData(payload);

      try {
        const resp = await apiPost({
          path,
          values: formData,
          contentType: 'application/json',
          cancelToken
        });

        if (resp !== undefined) {
          history.push(returnPath);
        }

      } catch {}
    },
  });

  const errorList: { [k: string]: JSX.Element } = {};
  for (const idx in validationError) {

    if (!formik.touched[idx]) {
      continue;
    }

    errorList[idx] = (
      <li key={idx}>{columns[idx].label}: {validationError[idx]}</li>
    );
  }

  return (
    <div>
      <form onSubmit={formik.handleSubmit}>
        <EntityForm
          {...props}
          entityService={entityService}
          formik={formik}
          create={true}
          validationErrors={errorList}
          match={match}
        />

        <SaveButton />
        {reqError && <ErrorMessage message={reqError} />}
      </form>
    </div>
  )
};

export default withRouter<any, any>(Create);
