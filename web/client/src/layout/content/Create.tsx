import { useState } from 'react';
import { withRouter } from "react-router-dom";
import { FormikHelpers, useFormik } from 'formik';
import {
  Button,
  makeStyles
} from '@material-ui/core';
import Title from 'layout/Title';
import ErrorMessage from './shared/ErrorMessage';
import EntityService from 'services/Entity/EntityService';
import EntityInterface from 'entities/EntityInterface';
import { useFormikType } from 'services/Form/types';
import { useStoreActions } from 'easy-peasy';

interface CreateProps extends EntityInterface {
  entityService: EntityService,
  history:any,
  match:any
}

const Create = (props:CreateProps) => {

  const { marshaller, path, history, title, columns } = props;
  const { Form: EntityForm, entityService }: { Form: any, entityService:EntityService } = props;
  const [error, setError] = useState(null);
  const apiPost = useStoreActions((actions:any) => {
      return actions.api.post
  });
  const classes = useStyles();

  const submit =  async (values:any , actions: FormikHelpers<any>) => {

      const {setSubmitting} = actions;

      try {

        await apiPost({
          path,
          values: marshaller(values),
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

  const initialValues:any = {
    ...entityService.getDefultValues(),
    ...props.initialValues
  }

  for (const idx in columns) {
    if (initialValues[idx] !== undefined) {
      continue;
    }

    initialValues[idx] = '';
  }

  console.log('initialValues', initialValues);

  const formik:useFormikType = useFormik({
    initialValues: initialValues,
    validate: props.validator,
    onSubmit: submit,
  });

  return (
    <div>
      <form onSubmit={formik.handleSubmit}>
        <Title>
          { title }
        </Title>
        <EntityForm formik={formik} create={true} classes={classes} {...props} />
        <br />
        <Button color="primary" variant="contained" type="submit">
          Submit
        </Button>
        { error && <ErrorMessage message={error} /> }
      </form>
    </div>
  )
};

const useStyles = makeStyles((theme:any) => ({
  dropDown: {
    minWidth: '250px'
  }
}));

export default withRouter<any, any>(Create);
