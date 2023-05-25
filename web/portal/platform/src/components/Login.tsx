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
  const {
    target,
    token,
  }: {
    target?: string;
    token?: string;
  } = qsArgs;

  const loggedIn = useStoreState((state) => state.auth.loggedIn);

  const exchangeToken = useStoreActions(
    (actions) => actions.auth.exchangeToken
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
  }, [target, token, exchangeToken, navigate, location.pathname]);

  useEffect(() => {
    if (target && token) {
      return;
    }
  }, [target, token, loggedIn]);

  if (loggedIn || (target && token)) {
    return null;
  }

  return <DefaultLogin validator={validator} />;
}
