import { useFormik } from 'formik';
import { Container } from '@mui/material';
import TextField from '@mui/material/TextField';
import LockOutlinedIcon from '@mui/icons-material/LockOutlined';
import { useStoreActions, useStoreState } from 'store';
import Title from '@irontec/ivoz-ui/components/Title';
import ErrorMessage from '@irontec/ivoz-ui/components/shared/ErrorMessage';
import { useFormikType } from '@irontec/ivoz-ui/services/form/types';
import { StyledLoginContainer, StyledAvatar, StyledForm, StyledSubmitButton } from './Login.styles';
import { EntityValidator } from '@irontec/ivoz-ui/entities/EntityInterface';

interface LoginProps {
  validator?: EntityValidator
}

export default function Login(props: LoginProps): JSX.Element {

  const error = useStoreState(
    (store) => store.api.errorMsg
  );

  const setToken = useStoreActions((actions) => actions.auth.setToken);
  const loadProfile = useStoreActions((actions) => actions.clientSession.acls.load);
  const setRefreshToken = useStoreActions((actions) => actions.auth.setRefreshToken);
  const apiPost = useStoreActions((actions) => actions.api.post)
  const submit = async (values: any) => {

    try {

      const response = await apiPost({
        path: '/admin_login',
        values,
        contentType: 'application/x-www-form-urlencoded'
      });

      if (response.data && response.data.token) {
        setToken(response.data.token);
        setRefreshToken(response.data.refreshToken);
        await loadProfile();
        return;
      }

    } catch (error: any) {
      console.error(error);
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