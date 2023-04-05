import { Login as DefaultLogin } from '@irontec/ivoz-ui/components';
import { EntityValidator } from '@irontec/ivoz-ui/entities/EntityInterface';
import queryString from 'query-string';
import { useEffect } from 'react';
import { useLocation, useNavigate } from 'react-router-dom';
import { useStoreActions, useStoreState } from 'store';

interface LoginProps {
  validator?: EntityValidator;
}

export default function Login(props: LoginProps): JSX.Element | null {
  const { validator } = props;

  const location = useLocation();
  const navigate = useNavigate();
  const qsArgs = queryString.parse(location.search);
  const { target, token }: { target?: string; token?: string } = qsArgs;

  const loggedIn = useStoreState((state) => state.auth.loggedIn);
  const aboutMe = useStoreState((state) => state.clientSession.aboutMe.profile);

  const exchangeToken = useStoreActions(
    (actions) => actions.auth.exchangeToken
  );

  const loadProfile = useStoreActions(
    (actions) => actions.clientSession.aboutMe.load
  );

  useEffect(() => {
    if (target && token) {
      exchangeToken({
        clientId: target,
        token,
      })
        .then((success: boolean) => {
          if (!success) {
            console.error('Unable to echange token');
            return;
          }

          navigate(`${location.pathname}/`, {
            replace: true,
            preventScrollReset: true,
          });
        })
        .catch((err: string) => {
          console.error(err);
        });
      return;
    }
  }, [target, token, exchangeToken, navigate]);

  useEffect(() => {
    if (target && token) {
      return;
    }

    if (loggedIn && !aboutMe) {
      loadProfile();
    }
  }, [target, token, loggedIn, aboutMe, loadProfile]);

  if (loggedIn || (target && token)) {
    return null;
  }

  return <DefaultLogin validator={validator} />;
}
