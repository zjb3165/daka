import Cookies from 'js-cookie'

const TokenKey = 'sys_admin_token'

export function getToken()
{
    return Cookies.get(TokenKey)
}

export function setToken()
{
    return Cookies.set(TokenKey, token)
}

export function removeToken()
{
    return Cookies.remove(TokenKey)
}