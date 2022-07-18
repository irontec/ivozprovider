import { Login as DefaultLogin } from '@irontec/ivoz-ui/components';
import { EntityValidator } from '@irontec/ivoz-ui/entities/EntityInterface';
import { useStoreState } from 'store';

interface LoginProps {
  validator?: EntityValidator;
}

export default function Login(props: LoginProps): JSX.Element | null {
  const { validator } = props;
  const loggedIn = useStoreState((state) => state.auth.loggedIn);

  const marshaller = (values: { username: string; password: string }) => {
    return {
      email: values.username,
      password: values.password,
    };
  };

  if (loggedIn) {
    return null;
  }

  return <DefaultLogin validator={validator} marshaller={marshaller} />;
}
