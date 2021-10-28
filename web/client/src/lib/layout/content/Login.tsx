import { useState } from 'react';
import { useFormik } from 'formik';
import { Container } from '@mui/material';
import TextField from '@mui/material/TextField';
import LockOutlinedIcon from '@mui/icons-material/LockOutlined';
import { useStoreActions } from 'easy-peasy';
import ApiClient from 'lib/services/api/ApiClient';
import Title from 'lib/layout/Title';
import ErrorMessage from './shared/ErrorMessage';
import { useFormikType } from 'lib/services/form/types';
import { StyledLoginContainer, StyledAvatar, StyledForm, StyledSubmitButton } from './Login.styles';
import { EntityValidator } from 'lib/entities/DefaultEntityBehavior';

interface LoginProps {
  validator?: EntityValidator
}

export default function Login(props: LoginProps): JSX.Element {

  const [error, setError] = useState<string | null>(null);

  const setToken = useStoreActions((actions: any) => actions.auth.setToken);
  const submit = async (values: any) => {

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

    } catch (error: any) {
      console.error(error);
      setError(error.toString());
    } finally {
    }
  };

  const formik: useFormikType = useFormik({
    initialValues: {
      'username': '',
      'password': ''
    },
    validationSchema: props.validator,
    onSubmit: submit,
  });

  return (
    <Container component="main" maxWidth="xs">
      <StyledLoginContainer>
        <StyledForm onSubmit={formik.handleSubmit}>
          <StyledAvatar>
            <LockOutlinedIcon />
          </StyledAvatar>
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
            margin="normal"
            required
            fullWidth
          />
          <StyledSubmitButton variant="contained">
            Sign In
          </StyledSubmitButton>
          {error && <ErrorMessage message={error} />}
        </StyledForm>
      </StyledLoginContainer>
    </Container>
  )
}