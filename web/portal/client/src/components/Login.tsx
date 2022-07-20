import { useEffect } from 'react';
import { useStoreActions, useStoreState } from 'store';
import { EntityValidator } from '@irontec/ivoz-ui/entities/EntityInterface';
import { Login as DefaultLogin } from '@irontec/ivoz-ui/components';

interface LoginProps {
  validator?: EntityValidator;
}

export default function Login(props: LoginProps): JSX.Element | null {
  const { validator } = props;

  const loggedIn = useStoreState((state) => state.auth.loggedIn);
  const aboutMe = useStoreState((state) => state.clientSession.aboutMe.profile);

  const loadProfile = useStoreActions(
    (actions) => actions.clientSession.aboutMe.load
  );

  useEffect(() => {
    if (loggedIn && !aboutMe) {
      loadProfile();
    }
  }, [loggedIn, aboutMe, loadProfile]);

  if (loggedIn) {
    return null;
  }

  return <DefaultLogin validator={validator} />;
}
