import { useState } from 'react';
import { useFormik, FormikHelpers } from 'formik';
import {
  Button, Container, makeStyles, Avatar
} from '@material-ui/core';
import TextField from '@material-ui/core/TextField';
import LockOutlinedIcon from '@material-ui/icons/LockOutlined';
import { useStoreActions } from 'easy-peasy';
import ApiClient from 'services/Api/ApiClient';
import Title from 'layout/Title';
import ErrorMessage from './shared/ErrorMessage';
import { useFormikType } from 'services/Form/types';

export default function Login(props:any) {

  const [error, setError] = useState(null);
  const classes = useStyles();

  const setToken = useStoreActions((actions:any) => actions.auth.setToken);
  const submit =  async (values:any , actions: FormikHelpers<any>) => {

      try {

        const response = await ApiClient.post(
          '/admin_login',
          values,
          'application/x-www-form-urlencoded'
        );

        if (response.data && response.data.token) {
          setToken(response.data.token);
          setError(null);
          return;
        }

        const error = {
          error: 'Token not found',
          toString: function () { return this.error }
        };

        throw error;

      } catch (error) {
          console.error(error);
          setError(error.toString());
      } finally {
      }
  };

  const formik:useFormikType = useFormik({
    initialValues: {
      'username': '',
      'password': ''
    },
    validationSchema: props.validator,
    onSubmit: submit,
  });

  return (
    <Container component="main" maxWidth="xs">
      <div className={classes.paper}>
        <form onSubmit={formik.handleSubmit} className={classes.form}>
          <Avatar className={classes.avatar}>
            <LockOutlinedIcon />
          </Avatar>
          <Title>
            Login
          </Title>
          <TextField
              name="username"
              type="text"
              label="Username"
              value={formik.values.username}
              onChange={formik.handleChange}
              error={formik.touched.username && Boolean(formik.errors.username)}
              helperText={formik.touched.username && formik.errors.username}
              variant="outlined"
              margin="normal"
              required
              fullWidth
          />
          <TextField
              name="password"
              type="password"
              label="Password"
              value={formik.values.password}
              onChange={formik.handleChange}
              error={formik.touched.password && Boolean(formik.errors.password)}
              helperText={formik.touched.password && formik.errors.password}
              variant="outlined"
              margin="normal"
              required
              fullWidth
          />
          <Button
            type="submit"
            fullWidth
            variant="contained"
            color="primary"
            className={classes.submit}
          >
            Sign In
          </Button>
          { error && <ErrorMessage message={error} /> }
        </form>
      </div>
    </Container>
  )
};

const useStyles = makeStyles((theme:any) => ({
  paper: {
    marginTop: theme.spacing(2),
    flexDirection: 'column',
    textAlign: 'center'
  },
  avatar: {
    margin: theme.spacing(1) + 'px auto',
    backgroundColor: theme.palette.secondary.main,
  },
  form: {
    width: '100%', // Fix IE 11 issue.
    marginTop: theme.spacing(1),
  },
  submit: {
    margin: theme.spacing(3, 0, 2),
  },
}));